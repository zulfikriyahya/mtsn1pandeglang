<?php
session_start();
header('Content-Type: application/json');
date_default_timezone_set('Asia/Jakarta');
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || ($_SESSION['user_role'] !== 'super_admin' && $_SESSION['user_role'] !== 'operator')) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Akses Ditolak: User biasa tidak bisa melakukan import.']);
    exit;
}

set_time_limit(2);
ini_set('memory_limit', '2048M');

try {
    $pdo = getDBConnection();
    $action = $_GET['action'] ?? '';

    if ($action === 'template') {
        $type = $_GET['type'] ?? 'feedback';
        $filename = "template_import_{$type}.csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        if ($type === 'feedback') {
            fputcsv($output, ['name', 'rating', 'message', 'created_at', 'ip_address']);
            fputcsv($output, ['Yahya Zulfikri', '5', 'Pelayanan sangat memuaskan.', '2022-07-01 08:00:00', '192.168.1.1']);
        } elseif ($type === 'survey') {
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

    if ($action === 'import' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File CSV tidak ditemukan atau error saat upload.");
        }

        $type = $_POST['type'] ?? '';
        $fileTmpPath = $_FILES['file']['tmp_name'];

        $handle = fopen($fileTmpPath, "r");
        if ($handle === FALSE) throw new Exception("Gagal membaca file.");

        $headers = fgetcsv($handle, 1000, ",");
        if (!$headers) throw new Exception("File CSV kosong.");

        $cleanHeaders = array_map(function ($h) {
            return strtolower(trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h)));
        }, $headers);

        $successCount = 0;
        $pdo->beginTransaction();

        try {
            if ($type === 'feedback') {
                if (!in_array('rating', $cleanHeaders)) throw new Exception("Format salah.");
                $stmt = $pdo->prepare("INSERT INTO feedback (name, rating, message, created_at, ip_address) VALUES (:name, :rating, :message, :created_at, :ip_address)");
                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    if (count($data) < 5) continue;
                    $stmt->execute([
                        ':name' => $data[0] ?: 'Anonim',
                        ':rating' => (int)$data[1],
                        ':message' => $data[2] ?: '',
                        ':created_at' => $data[3] ?: date('Y-m-d H:i:s'),
                        ':ip_address' => $data[4] ?: '127.0.0.1'
                    ]);
                    $successCount++;
                }
            } elseif ($type === 'survey') {
                $stmt = $pdo->prepare("INSERT INTO survey_responses 
                    (respondent_name, respondent_role, score_zi, score_service, score_academic, score_facilities, score_management, score_culture, feedback, created_at, ip_address, details_json) 
                    VALUES (:name, :role, :zi, :service, :acad, :fac, :mgt, :cul, :feedback, :created, :ip, '{}')");

                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    if (count($data) < 11) continue;
                    $stmt->execute([
                        ':name' => $data[0] ?: 'Anonim',
                        ':role' => $data[1] ?: 'Umum',
                        ':zi' => (float)$data[2],
                        ':service' => (float)$data[3],
                        ':acad' => (float)$data[4],
                        ':fac' => (float)$data[5],
                        ':mgt' => (float)$data[6],
                        ':cul' => (float)$data[7],
                        ':feedback' => $data[8] ?: '',
                        ':created' => $data[9] ?: date('Y-m-d H:i:s'),
                        ':ip' => $data[10] ?: '127.0.0.1'
                    ]);
                    $successCount++;
                }
            } elseif ($type === 'visits') {
                $stmt = $pdo->prepare("INSERT INTO site_visit_logs (ip_address, user_agent, created_at) VALUES (:ip, :ua, :created)");
                while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                    if (count($data) < 3) continue;
                    $stmt->execute([
                        ':ip' => $data[0] ?: '127.0.0.1',
                        ':ua' => $data[1] ?: 'Imported',
                        ':created' => $data[2] ?: date('Y-m-d H:i:s')
                    ]);
                    $successCount++;
                }
                $pdo->exec("UPDATE global_stats SET value = value + $successCount WHERE `key` = 'site_visits'");
            }

            $pdo->commit();
            fclose($handle);
            echo json_encode(['status' => 'success', 'message' => "Berhasil mengimport $successCount data."]);
        } catch (Exception $ex) {
            $pdo->rollBack();
            throw $ex;
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
