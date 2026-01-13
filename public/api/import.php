<?php
session_start();
header('Content-Type: application/json');
date_default_timezone_set('Asia/Jakarta');

// 1. Cek Login Admin
if (!isset($_SESSION['admin_logged_in']) || ($_SESSION['user_role'] !== 'super_admin' && $_SESSION['user_role'] !== 'operator')) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Akses Ditolak: User biasa tidak bisa melakukan import.']);
    exit;
}

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
            // PERBAIKAN: Template header disesuaikan dengan 6 kategori
            fputcsv($output, [
                'respondent_name',
                'respondent_role',
                'score_zi',
                'score_service',
                'score_academic',
                'score_facilities',
                'score_management',
                'score_culture',
                'feedback',
                'created_at',
                'ip_address'
            ]);
            fputcsv($output, [
                'Siti Aminah',
                'Wali Murid',
                '5.0',
                '4.5',
                '5.0',
                '4.8',
                '5.0',
                '4.9',
                'Fasilitas sangat lengkap, pertahankan.',
                '2024-01-02 14:30:00',
                '192.168.1.2'
            ]);
        } elseif ($type === 'visits') {
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

        $handle = fopen($fileTmpPath, "r");
        if ($handle === FALSE) throw new Exception("Gagal membaca file.");

        // Validasi Header
        $headers = fgetcsv($handle, 1000, ",");
        if (!$headers) throw new Exception("File CSV kosong.");

        $cleanHeaders = array_map(function ($h) {
            return strtolower(trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h)));
        }, $headers);

        $successCount = 0;
        $db->exec('BEGIN TRANSACTION');

        try {
            if ($type === 'feedback') {
                // ... (Logic Feedback tetap sama) ...
                if (!in_array('rating', $cleanHeaders)) throw new Exception("Format salah.");
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
                // PERBAIKAN: Query Insert untuk 6 Kategori
                // Memastikan urutan kolom CSV: 
                // 0:Name, 1:Role, 2:ZI, 3:Srv, 4:Acd, 5:Fac, 6:Mgt, 7:Cul, 8:Msg, 9:Date, 10:IP

                $stmt = $db->prepare("INSERT INTO survey_responses 
                    (respondent_name, respondent_role, score_zi, score_service, score_academic, score_facilities, score_management, score_culture, feedback, created_at, ip_address, details_json) 
                    VALUES (:name, :role, :zi, :service, :acad, :fac, :mgt, :cul, :feedback, :created, :ip, '{}')");

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    // Validasi jumlah kolom minimal (minimal 11 kolom sesuai generator)
                    if (count($data) < 11) continue;

                    $stmt->bindValue(':name', $data[0] ?: 'Anonim', SQLITE3_TEXT);
                    $stmt->bindValue(':role', $data[1] ?: 'Umum', SQLITE3_TEXT);

                    // Mapping Nilai Skor (Float)
                    $stmt->bindValue(':zi', (float)$data[2], SQLITE3_FLOAT);
                    $stmt->bindValue(':service', (float)$data[3], SQLITE3_FLOAT);
                    $stmt->bindValue(':acad', (float)$data[4], SQLITE3_FLOAT);
                    $stmt->bindValue(':fac', (float)$data[5], SQLITE3_FLOAT);
                    $stmt->bindValue(':mgt', (float)$data[6], SQLITE3_FLOAT);
                    $stmt->bindValue(':cul', (float)$data[7], SQLITE3_FLOAT);

                    // Mapping Teks
                    $stmt->bindValue(':feedback', $data[8] ?: '', SQLITE3_TEXT); // Index 8 adalah Pesan
                    $stmt->bindValue(':created', $data[9] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT); // Index 9 adalah Waktu
                    $stmt->bindValue(':ip', $data[10] ?: '127.0.0.1', SQLITE3_TEXT); // Index 10 adalah IP

                    $stmt->execute();
                    $successCount++;
                }
            } elseif ($type === 'visits') {
                // ... (Logic Visits tetap sama) ...
                $stmt = $db->prepare("INSERT INTO site_visit_logs (ip_address, user_agent, created_at) VALUES (:ip, :ua, :created)");
                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    if (count($data) < 3) continue;
                    $stmt->bindValue(':ip', $data[0] ?: '127.0.0.1', SQLITE3_TEXT);
                    $stmt->bindValue(':ua', $data[1] ?: 'Imported', SQLITE3_TEXT);
                    $stmt->bindValue(':created', $data[2] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);
                    $stmt->execute();
                    $successCount++;
                }
                $db->exec("UPDATE global_stats SET value = value + $successCount WHERE key = 'site_visits'");
            }

            $db->exec('COMMIT');
            fclose($handle);
            echo json_encode(['status' => 'success', 'message' => "Berhasil mengimport $successCount data."]);
        } catch (Exception $ex) {
            $db->exec('ROLLBACK');
            throw $ex;
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
