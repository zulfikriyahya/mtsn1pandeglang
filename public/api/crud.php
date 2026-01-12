<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);
    // [FIX] WAJIB: Aktifkan Mode WAL
    $db->busyTimeout(5000);
    $db->exec('PRAGMA journal_mode = WAL');

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $action = $_GET['action'] ?? '';

    if ($action === 'delete') {
        $type = $data['type'] ?? '';
        $ids = [];
        if (isset($data['ids']) && is_array($data['ids'])) {
            $ids = $data['ids'];
        } elseif (isset($data['id'])) {
            $ids = [$data['id']];
        }

        if (empty($ids)) throw new Exception("Tidak ada data yang dipilih.");

        $table = '';
        if ($type === 'feedback') {
            $table = 'feedback';
        } elseif ($type === 'survey') {
            $table = 'survey_responses';
        } else {
            throw new Exception("Tipe data tidak dikenal.");
        }

        $sanitized_ids = array_map('intval', $ids);
        $ids_string = implode(',', $sanitized_ids);

        $query = "DELETE FROM $table WHERE id IN ($ids_string)";

        if ($db->exec($query)) {
            $count = $db->changes();
            echo json_encode(['status' => 'success', 'message' => "$count data berhasil dihapus."]);
        } else {
            throw new Exception("Gagal menghapus data.");
        }
    } else {
        throw new Exception("Action tidak valid.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
