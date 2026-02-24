<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once __DIR__ . '/config.php';

function getClientIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
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

try {
    $pdo = getDBConnection();
    initPengaduanTable($pdo);
    $ip_address = getClientIP();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Validasi
        if (
            empty($data['nama']) || empty($data['email']) || empty($data['kategori']) ||
            empty($data['judul']) || empty($data['isi_pengaduan'])
        ) {
            throw new Exception("Semua field wajib diisi.");
        }

        // Sanitasi
        $nama = htmlspecialchars(strip_tags($data['nama']));
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) throw new Exception("Format email tidak valid.");

        $telepon = htmlspecialchars(strip_tags($data['telepon'] ?? ''));
        $kategori = htmlspecialchars(strip_tags($data['kategori']));
        $judul = htmlspecialchars(strip_tags($data['judul']));
        $isi = htmlspecialchars(strip_tags($data['isi_pengaduan']));

        // Insert
        $stmt = $pdo->prepare("INSERT INTO pengaduan 
            (nama, email, telepon, kategori, judul, isi_pengaduan, ip_address) 
            VALUES (:nama, :email, :telepon, :kategori, :judul, :isi, :ip)");

        $stmt->execute([
            ':nama' => $nama,
            ':email' => $email,
            ':telepon' => $telepon,
            ':kategori' => $kategori,
            ':judul' => $judul,
            ':isi' => $isi,
            ':ip' => $ip_address
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Pengaduan Anda telah kami terima. Terima kasih atas partisipasi Anda. Kami akan segera menindaklanjuti.'
        ]);
    } else {
        // GET request (optional: untuk cek statistik publik)
        $total = $pdo->query("SELECT COUNT(*) FROM pengaduan")->fetchColumn();
        $selesai = $pdo->query("SELECT COUNT(*) FROM pengaduan WHERE status = 'Selesai'")->fetchColumn();

        echo json_encode([
            'status' => 'ready',
            'stats' => [
                'total' => $total,
                'selesai' => $selesai
            ]
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
