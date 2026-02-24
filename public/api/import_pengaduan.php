<?php
session_start();
header('Content-Type: application/json');
date_default_timezone_set('Asia/Jakarta');
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || ($_SESSION['user_role'] !== 'super_admin' && $_SESSION['user_role'] !== 'operator')) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Akses Ditolak']);
    exit;
}

set_time_limit(120);
ini_set('memory_limit', '512M');

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

    $action = $_GET['action'] ?? '';

    if ($action === 'template') {
        $filename = "template_import_pengaduan.csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($output, ['nama', 'email', 'telepon', 'kategori', 'judul', 'isi_pengaduan', 'status', 'tanggapan', 'created_at', 'ip_address']);
        fputcsv($output, [
            'Budi Santoso',
            'budi.santoso@email.com',
            '081234567890',
            'Pelayanan',
            'Lambat dalam Pengurusan Surat',
            'Saya mengurus surat keterangan siswa sudah 1 minggu belum jadi. Mohon dipercepat prosesnya.',
            'Selesai',
            'Terima kasih atas laporannya. Surat sudah selesai dan dapat diambil.',
            '2024-12-01 09:00:00',
            '192.168.1.10'
        ]);
        fputcsv($output, [
            'Siti Nurhaliza',
            'siti.nur@email.com',
            '082345678901',
            'Fasilitas',
            'Toilet Rusak di Lantai 2',
            'Toilet wanita lantai 2 sudah beberapa hari tidak bisa digunakan karena rusak.',
            'Proses',
            'Sedang kami perbaiki, estimasi selesai 2 hari.',
            '2024-12-05 14:30:00',
            '192.168.1.11'
        ]);

        fclose($output);
        exit;
    }

    if ($action === 'import' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File CSV tidak ditemukan atau error saat upload.");
        }

        $fileTmpPath = $_FILES['file']['tmp_name'];
        $handle = fopen($fileTmpPath, "r");
        if ($handle === FALSE) throw new Exception("Gagal membaca file.");

        $headers = fgetcsv($handle, 1000, ",");
        if (!$headers) throw new Exception("File CSV kosong.");

        $cleanHeaders = array_map(function ($h) {
            return strtolower(trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h)));
        }, $headers);

        if (!in_array('nama', $cleanHeaders) || !in_array('email', $cleanHeaders)) {
            throw new Exception("Format CSV salah. Kolom 'nama' dan 'email' wajib ada.");
        }

        $successCount = 0;
        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare("INSERT INTO pengaduan 
                (nama, email, telepon, kategori, judul, isi_pengaduan, status, tanggapan, created_at, ip_address) 
                VALUES (:nama, :email, :telepon, :kategori, :judul, :isi, :status, :tanggapan, :created, :ip)");

            while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                if (count($data) < 6) continue;

                $stmt->execute([
                    ':nama' => $data[0] ?: 'Anonim',
                    ':email' => $data[1],
                    ':telepon' => $data[2] ?: '',
                    ':kategori' => $data[3] ?: 'Lainnya',
                    ':judul' => $data[4],
                    ':isi' => $data[5],
                    ':status' => $data[6] ?: 'Menunggu',
                    ':tanggapan' => $data[7] ?? '',
                    ':created' => $data[8] ?? date('Y-m-d H:i:s'),
                    ':ip' => $data[9] ?? '127.0.0.1'
                ]);
                $successCount++;
            }

            $pdo->commit();
            fclose($handle);

            echo json_encode([
                'status' => 'success',
                'message' => "Berhasil mengimport $successCount pengaduan."
            ]);
        } catch (Exception $ex) {
            $pdo->rollBack();
            throw $ex;
        }
    }

    if ($action === 'generate_dummy') {
        $dataDummy = [
            [
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@email.com',
                'telepon' => '081234567890',
                'kategori' => 'Pelayanan',
                'judul' => 'Pelayanan PPDB Kurang Informatif',
                'isi' => 'Mohon informasi PPDB diperjelas di website. Banyak orang tua yang bingung.',
                'status' => 'Selesai',
                'tanggapan' => 'Terima kasih, sudah kami update di website.'
            ],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@email.com',
                'telepon' => '082345678901',
                'kategori' => 'Fasilitas',
                'judul' => 'AC Kelas 8A Tidak Dingin',
                'isi' => 'AC di kelas 8A sudah lama tidak dingin. Siswa kepanasan saat belajar.',
                'status' => 'Proses',
                'tanggapan' => 'Sedang dalam perbaikan, estimasi selesai minggu depan.'
            ],
            [
                'nama' => 'Rudi Hermawan',
                'email' => 'rudi.h@email.com',
                'telepon' => '083456789012',
                'kategori' => 'Akademik',
                'judul' => 'Jadwal Pelajaran Sering Berubah',
                'isi' => 'Jadwal pelajaran sering berubah mendadak tanpa pemberitahuan yang jelas.',
                'status' => 'Menunggu',
                'tanggapan' => ''
            ],
            [
                'nama' => 'Nia Ramadhani',
                'email' => 'nia.rama@email.com',
                'telepon' => '084567890123',
                'kategori' => 'Keuangan',
                'judul' => 'Pembayaran SPP via Transfer Sulit',
                'isi' => 'Sistem pembayaran SPP via transfer sering error. Mohon diperbaiki.',
                'status' => 'Proses',
                'tanggapan' => 'Tim IT sedang memperbaiki sistem pembayaran.'
            ],
            [
                'nama' => 'Hendra Wijaya',
                'email' => 'hendra.w@email.com',
                'telepon' => '085678901234',
                'kategori' => 'SDM',
                'judul' => 'Guru Sering Terlambat Masuk Kelas',
                'isi' => 'Beberapa guru sering terlambat masuk kelas. Mohon ditindaklanjuti.',
                'status' => 'Selesai',
                'tanggapan' => 'Sudah kami tegur dan akan kami awasi kedisiplinannya.'
            ]
        ];

        $stmt = $pdo->prepare("INSERT INTO pengaduan 
            (nama, email, telepon, kategori, judul, isi_pengaduan, status, tanggapan, ip_address) 
            VALUES (:nama, :email, :telepon, :kategori, :judul, :isi, :status, :tanggapan, :ip)");

        $count = 0;
        foreach ($dataDummy as $dummy) {
            $stmt->execute([
                ':nama' => $dummy['nama'],
                ':email' => $dummy['email'],
                ':telepon' => $dummy['telepon'],
                ':kategori' => $dummy['kategori'],
                ':judul' => $dummy['judul'],
                ':isi' => $dummy['isi'],
                ':status' => $dummy['status'],
                ':tanggapan' => $dummy['tanggapan'],
                ':ip' => '127.0.0.1'
            ]);
            $count++;
        }

        echo json_encode([
            'status' => 'success',
            'message' => "Berhasil generate $count data dummy pengaduan."
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
