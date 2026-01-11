<?php
session_start();
header('Content-Type: application/json');

// 1. Cek Login Admin (Wajib)
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

    // Ambil Data JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $action = $_GET['action'] ?? '';

    // === HAPUS DATA ===
    if ($action === 'delete') {
        $type = $data['type'] ?? ''; // 'feedback' atau 'survey'
        $id = (int)($data['id'] ?? 0);

        if ($id <= 0) throw new Exception("ID tidak valid.");

        $table = '';
        if ($type === 'feedback') {
            $table = 'feedback';
        } elseif ($type === 'survey') {
            $table = 'survey_responses';
        } else {
            throw new Exception("Tipe data tidak dikenal.");
        }

        // Eksekusi Hapus
        $stmt = $db->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();

        // Cek apakah ada baris yang terhapus
        if ($db->changes() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            throw new Exception("Gagal menghapus atau data tidak ditemukan.");
        }
    } else {
        throw new Exception("Action tidak valid.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
