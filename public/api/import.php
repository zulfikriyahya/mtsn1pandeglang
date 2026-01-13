<?php
session_start();
header('Content-Type: application/json');
date_default_timezone_set('Asia/Jakarta'); // Tambahkan Timezone

// 1. Cek Login Admin
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
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

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
        } elseif ($type === 'visits') {
            // Template Baru: Kunjungan
            fputcsv($output, ['ip_address', 'user_agent', 'created_at']);
            fputcsv($output, ['192.168.1.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)...', '2024-02-01 08:00:00']);
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

        $fileExt = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if ($fileExt !== 'csv') throw new Exception("Format file harus .csv");

        $handle = fopen($fileTmpPath, "r");
        if ($handle === FALSE) throw new Exception("Gagal membaca file.");

        // --- VALIDASI HEADER ---
        $headers = fgetcsv($handle, 1000, ",");
        if (!$headers) throw new Exception("File CSV kosong atau tidak terbaca.");

        // Bersihkan Header (Trim, Lowercase, Hapus BOM/Karakter aneh dari Excel)
        $cleanHeaders = array_map(function ($h) {
            $h = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h);
            return strtolower(trim($h));
        }, $headers);

        if ($type === 'feedback') {
            if (!in_array('rating', $cleanHeaders) || !in_array('message', $cleanHeaders)) {
                fclose($handle);
                throw new Exception("Template salah. Kolom 'rating'/'message' tidak ditemukan.");
            }
        } elseif ($type === 'survey') {
            if (!in_array('score_zi', $cleanHeaders) || !in_array('respondent_role', $cleanHeaders)) {
                fclose($handle);
                throw new Exception("Template salah. Kolom 'score_zi'/'respondent_role' tidak ditemukan.");
            }
        } elseif ($type === 'visits') {
            // Validasi Header Kunjungan
            if (!in_array('ip_address', $cleanHeaders) || !in_array('user_agent', $cleanHeaders)) {
                fclose($handle);
                throw new Exception("Template salah. Kolom 'ip_address'/'user_agent' tidak ditemukan.");
            }
        } else {
            throw new Exception("Tipe import tidak dikenal.");
        }

        $successCount = 0;
        $db->exec('BEGIN TRANSACTION');

        try {
            if ($type === 'feedback') {
                $stmt = $db->prepare("INSERT INTO feedback (name, rating, message, created_at, ip_address) VALUES (:name, :rating, :message, :created_at, :ip_address)");
                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
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
            } elseif ($type === 'visits') {
                // Import Data Kunjungan
                $stmt = $db->prepare("INSERT INTO site_visit_logs (ip_address, user_agent, created_at) VALUES (:ip, :ua, :created)");
                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    if (count($data) < 3) continue;
                    $stmt->bindValue(':ip', $data[0] ?: '127.0.0.1', SQLITE3_TEXT);
                    $stmt->bindValue(':ua', $data[1] ?: 'Imported Agent', SQLITE3_TEXT);
                    $stmt->bindValue(':created', $data[2] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);
                    $stmt->execute();
                    $successCount++;
                }
                // Update Global Counter setelah import visits agar total di dashboard sinkron
                $db->exec("UPDATE global_stats SET value = value + $successCount WHERE key = 'site_visits'");
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
