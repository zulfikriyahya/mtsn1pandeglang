<?php
function getDBConnection()
{
    $host = getenv('DB_HOST') ?: '192.168.1.100';
    $port = getenv('DB_PORT') ?: '3306';
    $dbname = getenv('DB_DATABASE') ?: 'mtsn1pandeglang';
    $user = getenv('DB_USERNAME') ?: 'mtsn1pandeglang';
    $pass = getenv('DB_PASSWORD') ?: '18012000';

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
        return $pdo;
    } catch (PDOException $e) {
        throw new Exception("Database connection failed: " . $e->getMessage());
    }
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

    $stmt = $pdo->prepare("INSERT IGNORE INTO global_stats (`key`, value) VALUES ('site_visits', 0)");
    $stmt->execute();
}

function initializeComplaintsTables($pdo)
{
    // Tabel untuk pengaduan
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

    // Generate ticket number function
}

// Helper untuk generate nomor tiket
function generateTicketNumber($pdo)
{
    $prefix = 'ADU';
    $date = date('Ymd');

    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM complaints WHERE DATE(created_at) = CURDATE()");
    $stmt->execute();
    $row = $stmt->fetch();
    $sequence = str_pad(($row['total'] ?? 0) + 1, 4, '0', STR_PAD_LEFT);

    return "{$prefix}{$date}{$sequence}";
}
