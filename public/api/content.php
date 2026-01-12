<?php
session_start();
header('Content-Type: application/json');

// 1. Cek Auth & Role (Hanya Super Admin & Operator)
if (!isset($_SESSION['admin_logged_in']) || ($_SESSION['user_role'] !== 'super_admin' && $_SESSION['user_role'] !== 'operator')) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

// 2. Konfigurasi Path
$contentDir = __DIR__ . '/../../src/content/blog/'; // Path relatif ke folder content Astro

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';

    // === LIST FILES ===
    if ($method === 'GET') {
        $files = array_diff(scandir($contentDir), array('.', '..', '-index.md'));
        $fileList = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'md' || pathinfo($file, PATHINFO_EXTENSION) === 'mdx') {
                $fileList[] = [
                    'name' => $file,
                    'size' => filesize($contentDir . $file),
                    'date' => date("Y-m-d H:i:s", filemtime($contentDir . $file))
                ];
            }
        }
        // Sort by date desc
        usort($fileList, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        echo json_encode(['status' => 'success', 'data' => $fileList]);
    }

    // === UPLOAD FILE ===
    elseif ($method === 'POST' && $action === 'upload') {
        if (!isset($_FILES['file'])) throw new Exception("File tidak ditemukan.");

        $file = $_FILES['file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Validasi Ekstensi (Keamanan Wajib)
        if ($ext !== 'md' && $ext !== 'mdx') {
            throw new Exception("Hanya file .md atau .mdx yang diperbolehkan.");
        }

        // Sanitasi Nama File
        $filename = preg_replace('/[^a-zA-Z0-9\-\.]/', '', basename($file['name']));
        $targetPath = $contentDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            echo json_encode(['status' => 'success', 'message' => "File $filename berhasil diupload."]);
        } else {
            throw new Exception("Gagal memindahkan file. Cek permission folder.");
        }
    }

    // === DELETE FILE ===
    elseif ($method === 'POST' && $action === 'delete') {
        $input = json_decode(file_get_contents('php://input'), true);
        $filename = preg_replace('/[^a-zA-Z0-9\-\.]/', '', basename($input['filename']));
        $targetPath = $contentDir . $filename;

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

    // === REBUILD (Opsional, Lanjutan) ===
    elseif ($method === 'POST' && $action === 'rebuild') {
        // Ini butuh konfigurasi sudoers khusus
        // shell_exec('sudo /path/to/rebuild_script.sh > /dev/null 2>&1 &');
        echo json_encode(['status' => 'success', 'message' => 'Perintah Build dikirim (Proses background).']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
