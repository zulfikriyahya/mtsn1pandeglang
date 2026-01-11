<?php
session_start();
header('Content-Type: application/json');

// 1. Cek Login Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';

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
            // Header yang dibutuhkan untuk Feedback
            fputcsv($output, ['name', 'rating', 'message', 'created_at', 'ip_address']);
            // Contoh Data
            fputcsv($output, ['Budi Santoso', '5', 'Pelayanan sangat memuaskan, terima kasih.', '2024-01-01 10:00:00', '192.168.1.1']);
        } elseif ($type === 'survey') {
            // Header yang dibutuhkan untuk Survey
            fputcsv($output, ['respondent_name', 'respondent_role', 'score_zi', 'score_service', 'score_academic', 'feedback', 'created_at', 'ip_address']);
            // Contoh Data
            fputcsv($output, ['Siti Aminah', 'Wali Murid', '5', '4', '5', 'Tingkatkan terus kualitasnya.', '2024-01-02 14:30:00', '192.168.1.2']);
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

        // Baca Header
        $headers = fgetcsv($handle, 1000, ",");
        $successCount = 0;

        $db->exec('BEGIN TRANSACTION');

        try {
            if ($type === 'feedback') {
                $stmt = $db->prepare("INSERT INTO feedback (name, rating, message, created_at, ip_address) VALUES (:name, :rating, :message, :created_at, :ip_address)");

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Mapping data berdasarkan indeks header (Asumsi urutan sesuai template)
                    // Jika user mengubah urutan, logika ini perlu mapping yang lebih kompleks. 
                    // Kita asumsikan user memakai template kita.

                    // Validasi minimal
                    if (count($data) < 3) continue;

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

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (count($data) < 6) continue;

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
