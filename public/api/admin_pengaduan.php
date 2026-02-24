<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

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

function formatTanggalIndo($dateString)
{
    if (!$dateString) return "-";
    try {
        $date = new DateTime(
            $dateString . includes("Z")
                ? $dateString
                : $dateString . replace(" ", "T") . "Z"
        );
        return (new IntlDateFormatter(
            'id_ID',
            IntlDateFormatter::LONG,
            IntlDateFormatter::SHORT,
            'Asia/Jakarta'
        ))->format($date);
    } catch (Exception $e) {
        return $dateString;
    }
}

try {
    $pdo = getDBConnection();
    initPengaduanTable($pdo);

    $action = $_GET['action'] ?? 'list';

    if ($action === 'list') {
        header('Content-Type: application/json');

        $stmt = $pdo->query("SELECT * FROM pengaduan ORDER BY created_at DESC");
        $pengaduan = $stmt->fetchAll();

        $stats = [
            'total' => count($pengaduan),
            'menunggu' => 0,
            'proses' => 0,
            'selesai' => 0,
            'ditolak' => 0
        ];

        foreach ($pengaduan as $p) {
            $status = strtolower($p['status']);
            if (isset($stats[$status])) {
                $stats[$status]++;
            }
        }

        echo json_encode([
            'status' => 'success',
            'data' => $pengaduan,
            'stats' => $stats
        ]);
    } elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $id = (int)$data['id'];
        $status = $data['status'];
        $tanggapan = htmlspecialchars(strip_tags($data['tanggapan'] ?? ''));

        $stmt = $pdo->prepare("UPDATE pengaduan 
            SET status = :status, tanggapan = :tanggapan 
            WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':tanggapan' => $tanggapan,
            ':id' => $id
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Pengaduan diupdate']);
    } elseif ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_SESSION['user_role'] !== 'super_admin') {
            throw new Exception("Hanya Super Admin yang dapat menghapus pengaduan.");
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $ids = $data['ids'] ?? [];
        if (empty($ids)) throw new Exception("ID tidak valid.");

        $sanitized_ids = array_map('intval', $ids);
        $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));

        $stmt = $pdo->prepare("DELETE FROM pengaduan WHERE id IN ($placeholders)");
        $stmt->execute($sanitized_ids);

        echo json_encode([
            'status' => 'success',
            'message' => count($sanitized_ids) . ' pengaduan dihapus'
        ]);
    } elseif ($action === 'export') {
        $filename = "laporan_pengaduan_" . date('Y-m-d_His') . ".csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($output, ['ID', 'Tanggal', 'Nama', 'Email', 'Telepon', 'Kategori', 'Judul', 'Isi Pengaduan', 'Status', 'Tanggapan', 'IP Address']);

        $stmt = $pdo->query("SELECT * FROM pengaduan ORDER BY created_at DESC");
        while ($row = $stmt->fetch()) {
            fputcsv($output, [
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
                $row['ip_address']
            ]);
        }

        fclose($output);
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
