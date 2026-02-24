<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

// Hapus data feedback/survey hanya boleh super_admin
if ($_SESSION['user_role'] !== 'super_admin') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak: hanya Super Admin yang dapat menghapus data.']);
    exit;
}

try {
    $pdo = getDBConnection();
    $data   = json_decode(file_get_contents('php://input'), true);
    $action = $_GET['action'] ?? '';

    if ($action === 'delete') {
        $type = $data['type'] ?? '';
        $ids  = [];

        if (isset($data['ids']) && is_array($data['ids'])) {
            $ids = $data['ids'];
        } elseif (isset($data['id'])) {
            $ids = [$data['id']];
        }

        if (empty($ids)) throw new Exception('Tidak ada data yang dipilih.');

        $tableMap = [
            'feedback' => 'feedback',
            'survey'   => 'survey_responses',
        ];

        if (!isset($tableMap[$type])) throw new Exception('Tipe data tidak dikenal.');

        $table            = $tableMap[$type];
        $sanitized_ids    = array_map('intval', $ids);
        $placeholders     = implode(',', array_fill(0, count($sanitized_ids), '?'));

        $stmt = $pdo->prepare("DELETE FROM $table WHERE id IN ($placeholders)");
        $stmt->execute($sanitized_ids);

        echo json_encode(['status' => 'success', 'message' => $stmt->rowCount() . ' data berhasil dihapus.']);
    } else {
        throw new Exception('Action tidak valid.');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
