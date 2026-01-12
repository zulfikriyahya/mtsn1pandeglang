<?php
session_start();
header('Content-Type: application/json');

// 1. Cek Auth & Role (Hanya Super Admin & Operator)
if (!isset($_SESSION['admin_logged_in']) || ($_SESSION['user_role'] !== 'super_admin' && $_SESSION['user_role'] !== 'operator')) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

// Konfigurasi Path (Relatif dari folder public/api)
$baseDir = __DIR__ . '/../../';
$paths = [
    'article' => $baseDir . 'src/content/blog/',
    'image' => $baseDir . 'public/images/artikel/',
    'video' => $baseDir . 'public/videos/artikel/'
];

// Helper: Format Size
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    elseif ($bytes >= 1048576) $bytes = number_format($bytes / 1048576, 2) . ' MB';
    elseif ($bytes >= 1024) $bytes = number_format($bytes / 1024, 2) . ' KB';
    elseif ($bytes > 1) $bytes = $bytes . ' bytes';
    elseif ($bytes == 1) $bytes = $bytes . ' byte';
    else $bytes = '0 bytes';
    return $bytes;
}

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';
    $type = $_GET['type'] ?? 'article'; // article, image, video

    $targetDir = $paths[$type] ?? $paths['article'];

    // Pastikan folder ada, jika tidak buat
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0775, true);
    }

    // === GET LIST FILES ===
    if ($method === 'GET') {
        $files = array_diff(scandir($targetDir), array('.', '..', '-index.md', '.gitkeep'));
        $fileList = [];

        foreach ($files as $file) {
            $filePath = $targetDir . $file;
            if (is_file($filePath)) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $validExt = ($type === 'article') ? ['md', 'mdx'] : (($type === 'image') ? ['jpg', 'jpeg', 'png', 'webp', 'gif'] : ['mp4', 'webm']);

                if (in_array($ext, $validExt)) {
                    $fileList[] = [
                        'name' => $file,
                        'size' => formatSizeUnits(filesize($filePath)),
                        'date' => date("Y-m-d H:i", filemtime($filePath)),
                        'url' => ($type === 'article') ? null : "/$type" . "s/artikel/" . $file // URL publik untuk preview media
                    ];
                }
            }
        }
        // Sort by date desc (Terbaru diatas)
        usort($fileList, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        echo json_encode(['status' => 'success', 'data' => $fileList]);
    }

    // === UPLOAD FILE ===
    elseif ($method === 'POST' && $action === 'upload') {
        if (!isset($_FILES['file'])) throw new Exception("File tidak ditemukan.");

        $file = $_FILES['file'];
        $behavior = $_POST['behavior'] ?? 'ask'; // ask, overwrite, rename

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Validasi Ekstensi per Tipe
        $allowed = [
            'article' => ['md', 'mdx'],
            'image' => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
            'video' => ['mp4', 'webm']
        ];

        if (!in_array($ext, $allowed[$type])) {
            throw new Exception("Ekstensi file .$ext tidak diperbolehkan untuk kategori ini.");
        }

        // Sanitasi Nama File (Hanya alfanumerik, dash, dot)
        $filename = preg_replace('/[^a-zA-Z0-9\-\.]/', '-', basename($file['name']));
        // Fix multiple dashes
        $filename = preg_replace('/-+/', '-', $filename);

        $targetPath = $targetDir . $filename;

        // Cek Konflik
        if (file_exists($targetPath)) {
            if ($behavior === 'ask') {
                echo json_encode(['status' => 'conflict', 'message' => "File '$filename' sudah ada.", 'filename' => $filename]);
                exit;
            } elseif ($behavior === 'rename') {
                $filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . time() . '.' . $ext;
                $targetPath = $targetDir . $filename;
            }
            // If behavior === 'overwrite', we just continue and overwrite
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Set permission agar bisa dibaca/tulis
            chmod($targetPath, 0664);
            echo json_encode(['status' => 'success', 'message' => "File $filename berhasil diupload."]);
        } else {
            throw new Exception("Gagal memindahkan file ke server.");
        }
    }

    // === DELETE FILE (SUPER ADMIN ONLY) ===
    elseif ($method === 'POST' && $action === 'delete') {
        if ($_SESSION['user_role'] !== 'super_admin') {
            throw new Exception("Hanya Super Admin yang dapat menghapus file.");
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $filename = basename($input['filename']); // Security: basename only
        $targetPath = $targetDir . $filename;

        if (file_exists($targetPath)) {
            if (unlink($targetPath)) {
                echo json_encode(['status' => 'success', 'message' => "File $filename dihapus."]);
            } else {
                throw new Exception("Gagal menghapus file.");
            }
        } else {
            throw new Exception("File tidak ditemukan.");
        }
    }

    // === REBUILD WEBSITE (SUPER ADMIN ONLY) ===
    elseif ($method === 'POST' && $action === 'rebuild') {
        if ($_SESSION['user_role'] !== 'super_admin') {
            throw new Exception("Hanya Super Admin yang dapat melakukan Rebuild.");
        }

        // Panggil script rebuild.sh yang sudah dibuat
        // Pastikan user www-data memiliki hak eksekusi atau sudo NOPASSWD untuk script ini jika perlu
        $cmd = "bash " . $baseDir . "rebuild.sh > /dev/null 2>&1 &";
        shell_exec($cmd);

        echo json_encode(['status' => 'success', 'message' => 'Proses Rebuild sedang berjalan di latar belakang. Perubahan akan muncul dalam 1-2 menit.']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
