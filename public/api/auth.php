<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');

// Load Env Manual (Simulasi, karena di PHP Native jarang ada library dotenv bawaan)
// Di production, pastikan variabel ini ada di Server Environment atau hardcode untuk keamanan
$ADMIN_EMAIL_ENV = getenv('ADMIN_EMAIL') ?: 'dev.mtsn1pandeglang@gmail.com';

$dbPath = __DIR__ . '/../../stats.db';

try {
    $db = new SQLite3($dbPath);

    // 1. INIT TABLE USERS
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE NOT NULL,
        name TEXT,
        picture TEXT,
        role TEXT DEFAULT 'user', -- super_admin, operator, user
        status TEXT DEFAULT 'unverified', -- active, inactive, unverified
        verification_token TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 2. CEK SUPER ADMIN DARI ENV (Auto Seed)
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindValue(':email', $ADMIN_EMAIL_ENV, SQLITE3_TEXT);
    if (!$stmt->execute()->fetchArray()) {
        // Jika Super Admin belum ada di DB, buat baru
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
                // Update Nama & Foto terbaru dari Google
                $upd = $db->prepare("UPDATE users SET name = :name, picture = :pic WHERE id = :id");
                $upd->bindValue(':name', $payload['name'], SQLITE3_TEXT);
                $upd->bindValue(':pic', $payload['picture'], SQLITE3_TEXT);
                $upd->bindValue(':id', $user['id'], SQLITE3_INTEGER);
                $upd->execute();

                // Validasi Status
                if ($user['status'] === 'inactive') {
                    throw new Exception('Akun Anda dinonaktifkan. Hubungi Administrator.');
                }
                if ($user['status'] === 'unverified') {
                    throw new Exception('Akun belum diverifikasi. Silakan cek email Anda atau hubungi Admin.');
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
                // User belum terdaftar
                echo json_encode(['status' => 'unregistered', 'message' => 'Email belum terdaftar. Silakan registrasi.', 'email' => $email]);
            }
        } else {
            throw new Exception('Token Google tidak valid.');
        }
    }

    // === REGISTER ===
    elseif ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $id_token = $data['credential'] ?? '';

        if (!$id_token) throw new Exception('Token tidak ditemukan');

        // Verifikasi lagi token Google (Security)
        $url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $id_token;
        $response = @file_get_contents($url);
        $payload = json_decode($response, true);

        if (!isset($payload['email'])) throw new Exception('Token Invalid');

        $email = $payload['email'];
        $name = $payload['name'];
        $picture = $payload['picture'];

        // Generate Token Verifikasi
        $token = bin2hex(random_bytes(16));

        // Simpan ke DB (Role Default: user, Status: unverified)
        $stmt = $db->prepare("INSERT INTO users (email, name, picture, role, status, verification_token) VALUES (:email, :name, :pic, 'user', 'unverified', :token)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':pic', $picture, SQLITE3_TEXT);
        $stmt->bindValue(':token', $token, SQLITE3_TEXT);

        if ($stmt->execute()) {
            // --- SIMULASI KIRIM EMAIL ---
            // Di production, gunakan PHPMailer atau fungsi mail()
            // Di sini kita kirim link verifikasi sebagai respons JSON untuk testing
            $verifyLink = "https://" . $_SERVER['HTTP_HOST'] . "/api/auth.php?action=verify&token=" . $token;

            // Logika "Kirim Email" (Mockup)
            // mail($email, "Verifikasi Akun", "Klik link ini: $verifyLink");

            echo json_encode([
                'status' => 'success',
                'message' => 'Registrasi berhasil! Silakan cek email untuk verifikasi.',
                'debug_link' => $verifyLink // Hapus ini di production
            ]);
        } else {
            throw new Exception('Gagal mendaftar (Email mungkin sudah ada).');
        }
    }

    // === VERIFIKASI EMAIL ===
    elseif ($action === 'verify') {
        $token = $_GET['token'] ?? '';
        if (!$token) die("Token invalid.");

        $stmt = $db->prepare("UPDATE users SET status = 'active', verification_token = NULL WHERE verification_token = :token");
        $stmt->bindValue(':token', $token, SQLITE3_TEXT);
        $stmt->execute();

        if ($db->changes() > 0) {
            echo "<h1>Verifikasi Berhasil!</h1><p>Akun Anda telah aktif. Silakan kembali ke halaman login.</p><script>setTimeout(()=>window.location.href='/admin', 3000);</script>";
        } else {
            echo "<h1>Gagal Verifikasi</h1><p>Token salah atau sudah kadaluarsa.</p>";
        }
    }

    // === CEK SESSION ===
    elseif ($action === 'check') {
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            // FIX: Pastikan role memiliki fallback jika session lama masih nyangkut
            $role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'user';

            echo json_encode([
                'status' => 'authenticated',
                'user' => [
                    'name' => $_SESSION['user_name'] ?? 'Admin',
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
