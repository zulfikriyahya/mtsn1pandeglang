<?php
session_start();
header('Content-Type: application/json');
header('Cross-Origin-Opener-Policy: same-origin-allow-popups');
header('Referrer-Policy: no-referrer-when-downgrade');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');

// Konfigurasi Email Admin (Hardcode untuk keamanan ganda atau ambil dari env jika server support)
$ALLOWED_EMAIL = 'dev.mtsn1pandeglang@gmail.com';

$action = $_GET['action'] ?? '';

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $id_token = $data['credential'] ?? '';

    if (!$id_token) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Token tidak ditemukan']);
        exit;
    }

    // Verifikasi Token langsung ke Google (Tanpa Library Berat)
    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
    $response = file_get_contents($url);

    if ($response) {
        $payload = json_decode($response, true);

        // Cek Email & Verified Email
        if (isset($payload['email']) && $payload['email_verified'] == 'true') {
            if ($payload['email'] === $ALLOWED_EMAIL) {
                // Login Sukses
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_email'] = $payload['email'];
                $_SESSION['admin_name'] = $payload['name'];
                $_SESSION['admin_picture'] = $payload['picture'];

                echo json_encode([
                    'status' => 'success',
                    'user' => [
                        'name' => $payload['name'],
                        'email' => $payload['email'],
                        'picture' => $payload['picture']
                    ]
                ]);
            } else {
                http_response_code(403);
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak. Email tidak terdaftar sebagai Admin.']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Token Google tidak valid.']);
        }
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Gagal memverifikasi ke Google.']);
    }
} elseif ($action === 'check') {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo json_encode([
            'status' => 'authenticated',
            'user' => [
                'name' => $_SESSION['admin_name'],
                'email' => $_SESSION['admin_email'],
                'picture' => $_SESSION['admin_picture']
            ]
        ]);
    } else {
        echo json_encode(['status' => 'guest']);
    }
} elseif ($action === 'logout') {
    session_destroy();
    echo json_encode(['status' => 'success']);
}
