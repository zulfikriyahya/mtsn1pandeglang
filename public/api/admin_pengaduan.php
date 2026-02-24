<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
header('Content-Type: application/json');
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$userRole = $_SESSION['user_role'] ?? 'user';

function initPengaduanTable($pdo)
{
    $pdo->exec("CREATE TABLE IF NOT EXISTS pengaduan (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telepon VARCHAR(20),
        kategori VARCHAR(100) NOT NULL,
        judul VARCHAR(255) NOT NULL,
        isi_pengaduan TEXT NOT NULL,
        status VARCHAR(50) DEFAULT 'Menunggu',
        tanggapan TEXT,
        ip_address VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at),
        INDEX idx_status (status),
        INDEX idx_kategori (kategori)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
}

try {
    $pdo = getDBConnection();
    initPengaduanTable($pdo);

    $action = $_GET['action'] ?? 'list';

    if ($action === 'list') {
        $stmt = $pdo->query("SELECT * FROM pengaduan ORDER BY created_at DESC");
        $pengaduan = $stmt->fetchAll();

        $stats = ['total' => 0, 'menunggu' => 0, 'proses' => 0, 'selesai' => 0, 'ditolak' => 0];
        foreach ($pengaduan as $p) {
            $stats['total']++;
            $key = strtolower($p['status']);
            if (isset($stats[$key])) $stats[$key]++;
        }

        echo json_encode(['status' => 'success', 'data' => $pengaduan, 'stats' => $stats]);
    } elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // user biasa tidak boleh update
        if ($userRole === 'user') {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak: minimal role Operator.']);
            exit;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $id       = (int)($data['id'] ?? 0);
        $status   = htmlspecialchars(strip_tags($data['status'] ?? ''));
        $tanggapan = htmlspecialchars(strip_tags($data['tanggapan'] ?? ''));

        if (!$id) throw new Exception('ID tidak valid.');

        $validStatus = ['Menunggu', 'Proses', 'Selesai', 'Ditolak'];
        if (!in_array($status, $validStatus)) throw new Exception('Status tidak valid.');

        $stmt = $pdo->prepare("UPDATE pengaduan SET status = :status, tanggapan = :tanggapan WHERE id = :id");
        $stmt->execute([':status' => $status, ':tanggapan' => $tanggapan, ':id' => $id]);

        echo json_encode(['status' => 'success', 'message' => 'Pengaduan berhasil diperbarui.']);
    } elseif ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($userRole !== 'super_admin') {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak: hanya Super Admin.']);
            exit;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $ids = array_map('intval', $data['ids'] ?? []);

        if (empty($ids)) throw new Exception('Tidak ada data yang dipilih.');

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("DELETE FROM pengaduan WHERE id IN ($placeholders)");
        $stmt->execute($ids);

        echo json_encode(['status' => 'success', 'message' => $stmt->rowCount() . ' pengaduan berhasil dihapus.']);
    } elseif ($action === 'export') {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="laporan_pengaduan_' . date('Y-m-d_His') . '.csv"');

        $out = fopen('php://output', 'w');
        fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8

        fputcsv($out, ['ID', 'Tanggal', 'Nama', 'Email', 'Telepon', 'Kategori', 'Judul', 'Isi Pengaduan', 'Status', 'Tanggapan', 'IP Address']);

        $stmt = $pdo->query("SELECT * FROM pengaduan ORDER BY created_at DESC");
        while ($row = $stmt->fetch()) {
            fputcsv($out, [
                $row['id'],
                $row['created_at'],
                $row['nama'],
                $row['email'],
                $row['telepon'],
                $row['kategori'],
                $row['judul'],
                $row['isi_pengaduan'],
                $row['status'],
                $row['tanggapan'] ?: '-',
                $row['ip_address'],
            ]);
        }

        fclose($out);
        exit;
    } else {
        throw new Exception('Action tidak dikenali.');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
