<?php
session_start();
header('Content-Type: application/json');

// Matikan display error agar tidak merusak JSON (PENTING untuk menghindari Network Error)
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// 1. Cek Login Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';

// Cek permission file DB sebelum lanjut
if (!is_writable($dbPath)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'File database tidak bisa ditulis (Permission Denied). Hubungi Administrator Server.']);
    exit;
}

try {
    $db = new SQLite3($dbPath);
    // Timeout agar tidak error "database is locked"
    $db->busyTimeout(5000);

    $action = $_GET['action'] ?? '';

    // === ACTION: DOWNLOAD TEMPLATE CSV ===
    if ($action === 'template') {
        $type = $_GET['type'] ?? 'feedback';
        $filename = "template_import_{$type}.csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Tambahkan BOM untuk Excel Windows agar karakter aman
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        if ($type === 'feedback') {
            fputcsv($output, ['name', 'rating', 'message', 'created_at', 'ip_address']);
            fputcsv($output, ['Budi Santoso', '5', 'Pelayanan mantap', date('Y-m-d H:i:s'), '192.168.1.1']);
        } elseif ($type === 'survey') {
            fputcsv($output, ['respondent_name', 'respondent_role', 'score_zi', 'score_service', 'score_academic', 'feedback', 'created_at', 'ip_address']);
            fputcsv($output, ['Siti Aminah', 'Wali Murid', '5', '4', '5', 'Tingkatkan lagi', date('Y-m-d H:i:s'), '192.168.1.2']);
        }

        fclose($output);
        exit;
    }

    // === ACTION: IMPORT DATA ===
    if ($action === 'import' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File CSV tidak ditemukan atau error upload (Code: " . ($_FILES['file']['error'] ?? 'Unknown') . ")");
        }

        $type = $_POST['type'] ?? '';
        $fileTmpPath = $_FILES['file']['tmp_name'];

        // Deteksi Line Ending untuk kompatibilitas Windows/Mac
        ini_set('auto_detect_line_endings', true);

        $handle = fopen($fileTmpPath, "r");
        if ($handle === FALSE) throw new Exception("Gagal membaca file.");

        // Skip Header
        fgetcsv($handle, 1000, ",");

        $successCount = 0;
        $db->exec('BEGIN TRANSACTION');

        try {
            if ($type === 'feedback') {
                $stmt = $db->prepare("INSERT INTO feedback (name, rating, message, created_at, ip_address) VALUES (:name, :rating, :message, :created_at, :ip_address)");

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    // Bersihkan karakter aneh jika ada
                    $data = array_map('trim', $data);

                    if (count($data) < 2) continue; // Skip baris kosong

                    $name = !empty($data[0]) ? $data[0] : 'Anonim';
                    $rating = isset($data[1]) ? (int)$data[1] : 5;
                    // Pastikan rating valid
                    if ($rating < 1) $rating = 1;
                    if ($rating > 5) $rating = 5;

                    $msg = isset($data[2]) ? $data[2] : '';
                    $date = !empty($data[3]) ? $data[3] : date('Y-m-d H:i:s');
                    $ip = !empty($data[4]) ? $data[4] : '127.0.0.1';

                    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
                    $stmt->bindValue(':rating', $rating, SQLITE3_INTEGER);
                    $stmt->bindValue(':message', $msg, SQLITE3_TEXT);
                    $stmt->bindValue(':created_at', $date, SQLITE3_TEXT);
                    $stmt->bindValue(':ip_address', $ip, SQLITE3_TEXT);
                    $stmt->execute();
                    $successCount++;
                }
            } elseif ($type === 'survey') {
                $stmt = $db->prepare("INSERT INTO survey_responses (respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, created_at, ip_address, details_json) VALUES (:name, :role, :zi, :service, :acad, :feedback, :created, :ip, '{}')");

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    $data = array_map('trim', $data);

                    if (count($data) < 5) continue;

                    $name = !empty($data[0]) ? $data[0] : 'Anonim';
                    $role = !empty($data[1]) ? $data[1] : 'Umum';
                    $zi = isset($data[2]) ? (float)$data[2] : 0;
                    $srv = isset($data[3]) ? (float)$data[3] : 0;
                    $acd = isset($data[4]) ? (float)$data[4] : 0;
                    $fb = isset($data[5]) ? $data[5] : '';
                    $date = !empty($data[6]) ? $data[6] : date('Y-m-d H:i:s');
                    $ip = !empty($data[7]) ? $data[7] : '127.0.0.1';

                    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
                    $stmt->bindValue(':role', $role, SQLITE3_TEXT);
                    $stmt->bindValue(':zi', $zi, SQLITE3_FLOAT);
                    $stmt->bindValue(':service', $srv, SQLITE3_FLOAT);
                    $stmt->bindValue(':acad', $acd, SQLITE3_FLOAT);
                    $stmt->bindValue(':feedback', $fb, SQLITE3_TEXT);
                    $stmt->bindValue(':created', $date, SQLITE3_TEXT);
                    $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
                    $stmt->execute();
                    $successCount++;
                }
            } else {
                throw new Exception("Tipe import tidak dikenal.");
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
