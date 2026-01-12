<?php
session_start();
header('Content-Type: application/json');

// Cek Login & Role Super Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['user_role'] !== 'super_admin') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Akses Ditolak: Hanya Super Admin yang bisa menghapus data.']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $action = $_GET['action'] ?? '';

    if ($action === 'delete') {
        $type = $data['type'] ?? '';

        // UPDATE: Mendukung single ID atau multiple IDs
        $ids = [];
        if (isset($data['ids']) && is_array($data['ids'])) {
            $ids = $data['ids'];
        } elseif (isset($data['id'])) {
            $ids = [$data['id']];
        }

        if (empty($ids)) throw new Exception("Tidak ada data yang dipilih.");

        // Validasi Tipe Tabel
        $table = '';
        if ($type === 'feedback') {
            $table = 'feedback';
        } elseif ($type === 'survey') {
            $table = 'survey_responses';
        } else {
            throw new Exception("Tipe data tidak dikenal.");
        }

        // Sanitasi ID menjadi integer semua
        $sanitized_ids = array_map('intval', $ids);
        $ids_string = implode(',', $sanitized_ids);

        // Eksekusi Bulk Delete
        // Query: DELETE FROM table WHERE id IN (1, 2, 3)
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
