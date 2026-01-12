<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');

// Load Env Manual
$ADMIN_EMAIL_ENV = getenv('ADMIN_EMAIL') ?: 'dev.mtsn1pandeglang@gmail.com';

$dbPath = __DIR__ . '/../../stats.db';

try {
    $db = new SQLite3($dbPath);

    // 1. INIT TABLE USERS (Hapus kolom verification_token karena tidak dipakai lagi)
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE NOT NULL,
        name TEXT,
        picture TEXT,
        role TEXT DEFAULT 'user', -- super_admin, operator, user
        status TEXT DEFAULT 'active', -- active, inactive
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. CEK SUPER ADMIN DARI ENV (Auto Seed)
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindValue(':email', $ADMIN_EMAIL_ENV, SQLITE3_TEXT);
    if (!$stmt->execute()->fetchArray()) {
        $ins = $db->prepare("INSERT INTO users (email, name, role, status) VALUES (:email, 'Super Admin', 'super_admin', 'active')");
        $ins->bindValue(':email', $ADMIN_EMAIL_ENV, SQLITE3_TEXT);
        $ins->execute();
    }

    $action = $_GET['action'] ?? '';

    // === LOGIN ===
    if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $id_token = $data['credential'] ?? '';

        if (!$id_token) throw new Exception('Token tidak ditemukan');

        // Verifikasi ke Google
        $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
        $response = @file_get_contents($url);

        if (!$response) throw new Exception('Gagal koneksi ke Google.');
        $payload = json_decode($response, true);

        if (isset($payload['email']) && $payload['email_verified'] == 'true') {
            $email = $payload['email'];

            // Cek User di Database
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $user = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

            if ($user) {
                // Update Data Terbaru Google
                $upd = $db->prepare("UPDATE users SET name = :name, picture = :pic WHERE id = :id");
                $upd->bindValue(':name', $payload['name'], SQLITE3_TEXT);
                $upd->bindValue(':pic', $payload['picture'], SQLITE3_TEXT);
                $upd->bindValue(':id', $user['id'], SQLITE3_INTEGER);
                $upd->execute();

                // Cek Status (Hanya Inactive yang ditolak)
                if ($user['status'] === 'inactive') {
                    throw new Exception('Akun Anda dinonaktifkan. Hubungi Administrator.');
                }

                // Set Session
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $payload['name'];
                $_SESSION['user_picture'] = $payload['picture'];
                $_SESSION['user_role'] = $user['role'];

                echo json_encode([
                    'status' => 'success',
                    'user' => [
                        'name' => $payload['name'],
                        'email' => $email,
                        'picture' => $payload['picture'],
                        'role' => $user['role']
                    ]
                ]);
            } else {
                echo json_encode(['status' => 'unregistered', 'message' => 'Email belum terdaftar.', 'email' => $email]);
            }
        } else {
            throw new Exception('Token Google tidak valid.');
        }
    }

    // === REGISTER (LANGSUNG AKTIF) ===
    elseif ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $id_token = $data['credential'] ?? '';

        if (!$id_token) throw new Exception('Token tidak ditemukan');

        $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
        $response = @file_get_contents($url);
        $payload = json_decode($response, true);

        if (!isset($payload['email'])) throw new Exception('Token Invalid');

        $email = $payload['email'];
        $name = $payload['name'];
        $picture = $payload['picture'];

        // Cek double register
        $cek = $db->prepare("SELECT id FROM users WHERE email = :email");
        $cek->bindValue(':email', $email, SQLITE3_TEXT);
        if ($cek->execute()->fetchArray()) {
            throw new Exception("Email sudah terdaftar. Silakan login.");
        }

        // Simpan User Baru (Status Langsung Active)
        $stmt = $db->prepare("INSERT INTO users (email, name, picture, role, status) VALUES (:email, :name, :pic, 'user', 'active')");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':pic', $picture, SQLITE3_TEXT);

        if ($stmt->execute()) {
            // AUTO LOGIN SETELAH REGISTER
            $newId = $db->lastInsertRowID();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['user_id'] = $newId;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_picture'] = $picture;
            $_SESSION['user_role'] = 'user'; // Default Role

            echo json_encode([
                'status' => 'success',
                'message' => 'Registrasi berhasil! Selamat datang.',
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'picture' => $picture,
                    'role' => 'user'
                ]
            ]);
        } else {
            throw new Exception('Gagal mendaftar.');
        }
    }

    // === CEK SESSION ===
    elseif ($action === 'check') {
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            $role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'user';
            echo json_encode([
                'status' => 'authenticated',
                'user' => [
                    'name' => $_SESSION['user_name'] ?? 'User',
                    'email' => $_SESSION['user_email'] ?? '',
                    'picture' => $_SESSION['user_picture'] ?? '',
                    'role' => $role
                ]
            ]);
        } else {
            echo json_encode(['status' => 'guest']);
        }
    }

    // === LOGOUT ===
    elseif ($action === 'logout') {
        session_destroy();
        echo json_encode(['status' => 'success']);
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
