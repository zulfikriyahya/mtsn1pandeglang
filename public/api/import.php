<?php
session_start();
// Matikan display error agar tidak merusak JSON (PENTING)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
header('Content-Type: application/json');

try {
    // 1. Cek Login Admin
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        throw new Exception("Unauthorized access.");
    }

    // 2. Koneksi Database
    $dbPath = __DIR__ . '/../../stats.db';

    // Cek Permission File
    if (file_exists($dbPath) && !is_writable($dbPath)) {
        throw new Exception("File database terkunci (Permission Denied). Mohon cek izin file stats.db");
    }

    // Cek Permission Folder (untuk file .wal)
    if (!is_writable(dirname($dbPath))) {
        throw new Exception("Folder database terkunci. Mohon cek izin folder root.");
    }

    $db = new SQLite3($dbPath);
    $db->busyTimeout(5000);

    $action = $_GET['action'] ?? '';

    // === ACTION: IMPORT ===
    if ($action === 'import' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Upload failed with error code: " . ($_FILES['file']['error'] ?? 'Unknown'));
        }

        $type = $_POST['type'] ?? '';
        $fileTmpPath = $_FILES['file']['tmp_name'];

        // Baca CSV
        ini_set('auto_detect_line_endings', true);
        $handle = fopen($fileTmpPath, "r");
        if (!$handle) throw new Exception("Tidak bisa membaca file temporary.");

        // Skip Header
        fgetcsv($handle, 1000, ",");

        $successCount = 0;
        $db->exec('BEGIN TRANSACTION');

        try {
            if ($type === 'feedback') {
                // Cek kolom ip_address secara dinamis
                $resCols = $db->query("PRAGMA table_info(feedback)");
                $hasIp = false;
                while ($col = $resCols->fetchArray()) {
                    if ($col['name'] === 'ip_address') $hasIp = true;
                }

                // Query Adaptif
                $fields = ['name', 'rating', 'message', 'created_at'];
                $params = [':name', ':rating', ':message', ':created_at'];

                if ($hasIp) {
                    $fields[] = 'ip_address';
                    $params[] = ':ip_address';
                }

                $sql = "INSERT INTO feedback (" . implode(',', $fields) . ") VALUES (" . implode(',', $params) . ")";
                $stmt = $db->prepare($sql);

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    $data = array_map('trim', $data);
                    if (count($data) < 2) continue;

                    $stmt->bindValue(':name', $data[0] ?: 'Anonim', SQLITE3_TEXT);
                    $stmt->bindValue(':rating', max(1, min(5, (int)($data[1] ?? 5))), SQLITE3_INTEGER);
                    $stmt->bindValue(':message', $data[2] ?? '', SQLITE3_TEXT);
                    $stmt->bindValue(':created_at', $data[3] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);
                    if ($hasIp) $stmt->bindValue(':ip_address', $data[4] ?? '127.0.0.1', SQLITE3_TEXT);

                    $stmt->execute();
                    $successCount++;
                }
            } elseif ($type === 'survey') {
                // Cek kolom dinamis
                $resCols = $db->query("PRAGMA table_info(survey_responses)");
                $cols = [];
                while ($col = $resCols->fetchArray()) {
                    $cols[] = $col['name'];
                }

                $hasIp = in_array('ip_address', $cols);
                $hasJson = in_array('details_json', $cols);

                // Build query
                $fields = ['respondent_name', 'respondent_role', 'score_zi', 'score_service', 'score_academic', 'feedback', 'created_at'];
                $params = [':name', ':role', ':zi', ':service', ':acad', ':feedback', ':created'];

                if ($hasIp) {
                    $fields[] = 'ip_address';
                    $params[] = ':ip';
                }
                if ($hasJson) {
                    $fields[] = 'details_json';
                    $params[] = ':json';
                }

                $sql = "INSERT INTO survey_responses (" . implode(',', $fields) . ") VALUES (" . implode(',', $params) . ")";
                $stmt = $db->prepare($sql);

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    $data = array_map('trim', $data);
                    if (count($data) < 5) continue;

                    $stmt->bindValue(':name', $data[0] ?: 'Anonim', SQLITE3_TEXT);
                    $stmt->bindValue(':role', $data[1] ?: 'Umum', SQLITE3_TEXT);
                    $stmt->bindValue(':zi', (float)($data[2] ?? 0), SQLITE3_FLOAT);
                    $stmt->bindValue(':service', (float)($data[3] ?? 0), SQLITE3_FLOAT);
                    $stmt->bindValue(':acad', (float)($data[4] ?? 0), SQLITE3_FLOAT);
                    $stmt->bindValue(':feedback', $data[5] ?? '', SQLITE3_TEXT);
                    $stmt->bindValue(':created', $data[6] ?: date('Y-m-d H:i:s'), SQLITE3_TEXT);

                    if ($hasIp) $stmt->bindValue(':ip', $data[7] ?? '127.0.0.1', SQLITE3_TEXT);
                    if ($hasJson) $stmt->bindValue(':json', '{}', SQLITE3_TEXT);

                    $stmt->execute();
                    $successCount++;
                }
            }

            $db->exec('COMMIT');
            fclose($handle);
            echo json_encode(['status' => 'success', 'message' => "Sukses import $successCount data."]);
        } catch (Exception $ex) {
            $db->exec('ROLLBACK');
            throw $ex;
        }
    }
    // === ACTION: TEMPLATE ===
    elseif ($action === 'template') {
        $type = $_GET['type'] ?? 'feedback';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="template_' . $type . '.csv"');
        $out = fopen('php://output', 'w');
        fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM

        if ($type === 'feedback') {
            fputcsv($out, ['name', 'rating', 'message', 'created_at', 'ip_address']);
            fputcsv($out, ['Budi', '5', 'Mantap', date('Y-m-d H:i:s'), '127.0.0.1']);
        } else {
            fputcsv($out, ['respondent_name', 'respondent_role', 'score_zi', 'score_service', 'score_academic', 'feedback', 'created_at', 'ip_address']);
            fputcsv($out, ['Siti', 'Wali Murid', '5', '4', '5', 'Oke', date('Y-m-d H:i:s'), '127.0.0.1']);
        }
        fclose($out);
    } else {
        throw new Exception("Invalid Action");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
