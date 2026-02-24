<?php
function getDBConnection()
{
    $host   = getenv('DB_HOST')     ?: '192.168.1.100';
    $port   = getenv('DB_PORT')     ?: '3306';
    $dbname = getenv('DB_DATABASE') ?: 'mtsn1pandeglang';
    $user   = getenv('DB_USERNAME') ?: 'mtsn1pandeglang';
    $pass   = getenv('DB_PASSWORD') ?: '18012000';

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        throw new Exception("Database connection failed: " . $e->getMessage());
    }
}

/**
 * Kembalikan data penandatangan laporan PDF.
 * Semua nilai bisa di-override via environment variable.
 *
 * Env vars yang didukung:
 *   SIGN_TU_NAME      — Nama Kepala Tata Usaha
 *   SIGN_TU_NIP       — NIP Kepala Tata Usaha
 *   SIGN_TU_IMG       — Path file TTE (relatif dari public/images/instansi/)
 *   SIGN_PUSDATIN_NAME — Nama Koordinator Tim Pusdatin
 *   SIGN_PUSDATIN_NIP  — NIP Koordinator Tim Pusdatin
 *   SIGN_PUSDATIN_IMG  — Path file TTE Pusdatin
 *   SIGN_KAMAD_NAME   — Nama Kepala Madrasah
 *   SIGN_KAMAD_NIP    — NIP Kepala Madrasah
 *   SIGN_KAMAD_IMG    — Path file TTE Kepala Madrasah
 *   SIGN_CITY         — Kota untuk baris penandatanganan (default: Pandeglang)
 */
function getSignatories(): array
{
    $imgBase = '../images/instansi/';

    return [
        'tu' => [
            'name' => getenv('SIGN_TU_NAME') ?: "UMAR MU'TAMAR, S.Ag.",
            'nip'  => getenv('SIGN_TU_NIP')  ?: '196903061998031004',
            'role' => 'Kepala Tata Usaha,',
            'img'  => $imgBase . (getenv('SIGN_TU_IMG') ?: 'tte-kepala-tata-usaha.png'),
        ],
        'pusdatin' => [
            'name' => getenv('SIGN_PUSDATIN_NAME') ?: 'YAHYA ZULFIKRI',
            'nip'  => getenv('SIGN_PUSDATIN_NIP')  ?: '200001142025211016',
            'role' => 'Koordinator Tim Pusdatin,',
            'img'  => $imgBase . (getenv('SIGN_PUSDATIN_IMG') ?: 'tte-koordinator-tim-pusdatin.png'),
        ],
        'kamad' => [
            'name' => getenv('SIGN_KAMAD_NAME') ?: 'H. EMAN SULAIMAN, S.Ag., M.Pd.',
            'nip'  => getenv('SIGN_KAMAD_NIP')  ?: '197006032000031002',
            'role' => 'Kepala Madrasah,',
            'img'  => $imgBase . (getenv('SIGN_KAMAD_IMG') ?: 'tte-kepala-madrasah.png'),
        ],
        'city' => getenv('SIGN_CITY') ?: 'Pandeglang',
    ];
}

function initializeTables($pdo)
{
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        name VARCHAR(255),
        picture TEXT,
        role VARCHAR(50) DEFAULT 'user',
        status VARCHAR(50) DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS global_stats (
        `key` VARCHAR(100) PRIMARY KEY,
        value BIGINT DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS site_visit_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(100),
        user_agent TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS post_stats (
        slug VARCHAR(255) PRIMARY KEY,
        views BIGINT DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS feedback (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        rating INT NOT NULL,
        message TEXT,
        ip_address VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $pdo->exec("CREATE TABLE IF NOT EXISTS survey_responses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        respondent_name VARCHAR(255),
        respondent_role VARCHAR(100),
        score_zi DECIMAL(3,2) DEFAULT 0,
        score_service DECIMAL(3,2) DEFAULT 0,
        score_academic DECIMAL(3,2) DEFAULT 0,
        score_facilities DECIMAL(3,2) DEFAULT 0,
        score_management DECIMAL(3,2) DEFAULT 0,
        score_culture DECIMAL(3,2) DEFAULT 0,
        feedback TEXT,
        details_json TEXT,
        ip_address VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created_at (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $pdo->prepare("INSERT IGNORE INTO global_stats (`key`, value) VALUES ('site_visits', 0)")->execute();
}

function initializeComplaintsTables($pdo)
{
    $pdo->exec("CREATE TABLE IF NOT EXISTS complaints (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ticket_number VARCHAR(50) UNIQUE NOT NULL,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        phone VARCHAR(50),
        category VARCHAR(100) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        attachment VARCHAR(255),
        status VARCHAR(50) DEFAULT 'pending',
        priority VARCHAR(50) DEFAULT 'normal',
        admin_response TEXT,
        responded_at TIMESTAMP NULL,
        responded_by VARCHAR(255),
        ip_address VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_ticket (ticket_number),
        INDEX idx_status (status),
        INDEX idx_category (category),
        INDEX idx_created (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
}

function generateTicketNumber($pdo)
{
    $date = date('Ymd');
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM complaints WHERE DATE(created_at) = CURDATE()");
    $stmt->execute();
    $row      = $stmt->fetch();
    $sequence = str_pad(($row['total'] ?? 0) + 1, 4, '0', STR_PAD_LEFT);
    return "ADU{$date}{$sequence}";
}
