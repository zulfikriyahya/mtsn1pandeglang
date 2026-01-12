<?php
session_start();
header('Content-Type: application/json');

// 1. Cek Login Admin
// Cek Login & Role (Super Admin OR Operator)
// User biasa TIDAK BOLEH import
if (!isset($_SESSION['admin_logged_in']) || ($_SESSION['user_role'] !== 'super_admin' && $_SESSION['user_role'] !== 'operator')) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Akses Ditolak: User biasa tidak bisa melakukan import.']);
    exit;
}

// Konfigurasi untuk handle file besar
set_time_limit(0);
ini_set('memory_limit', '512M');

$dbPath = __DIR__ . '/../../database.db';

try {
    $db = new SQLite3($dbPath);
    $action = $_GET['action'] ?? '';

    // === ACTION: DOWNLOAD TEMPLATE CSV ===
    if ($action === 'template') {
        $type = $_GET['type'] ?? 'feedback';
        $filename = "template_import_{$type}.csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        if ($type === 'feedback') {
            fputcsv($output, ['name', 'rating', 'message', 'created_at', 'ip_address']);
            fputcsv($output, ['Budi Santoso', '5', 'Pelayanan sangat memuaskan.', '2024-01-01 10:00:00', '192.168.1.1']);
        } elseif ($type === 'survey') {
            fputcsv($output, ['respondent_name', 'respondent_role', 'score_zi', 'score_service', 'score_academic', 'feedback', 'created_at', 'ip_address']);
            fputcsv($output, ['Siti Aminah', 'Wali Murid', '5', '4', '5', 'Pertahankan kualitas.', '2024-01-02 14:30:00', '192.168.1.2']);
        }
        fclose($output);
        exit;
    }

    // === ACTION: IMPORT DATA ===
    if ($action === 'import' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File CSV tidak ditemukan atau error saat upload.");
        }

        $type = $_POST['type'] ?? '';
        $fileTmpPath = $_FILES['file']['tmp_name'];

        // Validasi Ekstensi
        $fileExt = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if ($fileExt !== 'csv') {
            throw new Exception("Format file harus .csv");
        }

        $handle = fopen($fileTmpPath, "r");
        if ($handle === FALSE) throw new Exception("Gagal membaca file.");

        // --- VALIDASI HEADER CSV (FITUR BARU) ---
        // Baca baris pertama (Header)
        $headers = fgetcsv($handle, 1000, ",");

        if (!$headers) throw new Exception("File CSV kosong atau tidak terbaca.");

        // Bersihkan Header (Trim, Lowercase, Hapus BOM/Karakter aneh dari Excel)
        $cleanHeaders = array_map(function ($h) {
            // Menghapus karakter non-printable (BOM utf-8 sering muncul di awal file Excel)
            $h = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h);
            return strtolower(trim($h));
        }, $headers);

        // Logika Pengecekan Kecocokan Kolom
        if ($type === 'feedback') {
            // Pastikan ada kolom 'rating' dan 'message' (Ciri khas Feedback)
            if (!in_array('rating', $cleanHeaders) || !in_array('message', $cleanHeaders)) {
                fclose($handle);
                throw new Exception("VALIDASI GAGAL: Anda memilih import 'Data Ulasan', tetapi file CSV ini tampaknya bukan template Ulasan (Kolom 'rating'/'message' tidak ditemukan).");
            }
        } elseif ($type === 'survey') {
            // Pastikan ada kolom 'score_zi' dan 'respondent_role' (Ciri khas Survey)
            if (!in_array('score_zi', $cleanHeaders) || !in_array('respondent_role', $cleanHeaders)) {
                fclose($handle);
                throw new Exception("VALIDASI GAGAL: Anda memilih import 'Data Survei', tetapi file CSV ini tampaknya bukan template Survei (Kolom 'score_zi'/'respondent_role' tidak ditemukan).");
            }
        } else {
            throw new Exception("Tipe import tidak dikenal.");
        }
        // --- AKHIR VALIDASI ---

        $successCount = 0;
        $db->exec('BEGIN TRANSACTION');

        try {
            if ($type === 'feedback') {
                $stmt = $db->prepare("INSERT INTO feedback (name, rating, message, created_at, ip_address) VALUES (:name, :rating, :message, :created_at, :ip_address)");

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    // Validasi jumlah kolom minimal agar tidak error index offset
                    if (count($data) < 5) continue;

                    $stmt->bindValue(':name', $data[0] ?: 'Anonim', SQLITE3_TEXT);
                    $stmt->bindValue(':rating', (int)$data[1], SQLITE3_INTEGER);
                    $stmt->bindValue(':message', $data[2] ?: '', SQLITE3_TEXT);
                    $stmt->bindValue(':created_at', $data[3] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);
                    $stmt->bindValue(':ip_address', $data[4] ?: '127.0.0.1', SQLITE3_TEXT);
                    $stmt->execute();
                    $successCount++;
                }
            } elseif ($type === 'survey') {
                $stmt = $db->prepare("INSERT INTO survey_responses (respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, created_at, ip_address, details_json) VALUES (:name, :role, :zi, :service, :acad, :feedback, :created, :ip, '{}')");

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    if (count($data) < 8) continue;

                    $stmt->bindValue(':name', $data[0] ?: 'Anonim', SQLITE3_TEXT);
                    $stmt->bindValue(':role', $data[1] ?: 'Umum', SQLITE3_TEXT);
                    $stmt->bindValue(':zi', (float)$data[2], SQLITE3_FLOAT);
                    $stmt->bindValue(':service', (float)$data[3], SQLITE3_FLOAT);
                    $stmt->bindValue(':acad', (float)$data[4], SQLITE3_FLOAT);
                    $stmt->bindValue(':feedback', $data[5] ?: '', SQLITE3_TEXT);
                    $stmt->bindValue(':created', $data[6] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);
                    $stmt->bindValue(':ip', $data[7] ?: '127.0.0.1', SQLITE3_TEXT);
                    $stmt->execute();
                    $successCount++;
                }
            }

            $db->exec('COMMIT');
            fclose($handle);
            echo json_encode(['status' => 'success', 'message' => "Validasi Sukses! Berhasil mengimport $successCount data."]);
        } catch (Exception $ex) {
            $db->exec('ROLLBACK');
            throw $ex;
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
