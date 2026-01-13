<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Sesuaikan dengan domain produksi nanti
header('Access-Control-Allow-Methods: GET, POST');
session_start();
$dbPath = __DIR__ . '/../../database.db';

function getClientIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed on PHP");
    }
    $db = new SQLite3($dbPath);

    // Tabel Counter Global (Ringkasan)
    $db->exec("CREATE TABLE IF NOT EXISTS global_stats (key TEXT PRIMARY KEY, value INTEGER DEFAULT 0)");

    // Tabel Detail Log Kunjungan (Baru)
    $db->exec("CREATE TABLE IF NOT EXISTS site_visit_logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        ip_address TEXT,
        user_agent TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS post_stats (slug TEXT PRIMARY KEY, views INTEGER DEFAULT 0)");
    $db->exec("INSERT OR IGNORE INTO global_stats (key, value) VALUES ('site_visits', 0)");

    $action = $_GET['action'] ?? '';
    $slug   = $_GET['slug'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];

    $response = ['value' => 0];

    if ($action === 'visit') {
        if ($method === 'POST') {
            // Logika Session untuk mencegah F5 spamming counter global
            if (!isset($_SESSION['has_visited_site'])) {
                // 1. Update Counter Global
                $db->exec("UPDATE global_stats SET value = value + 1 WHERE key = 'site_visits'");

                // 2. Catat Detail Log Kunjungan (IP & Browser)
                $ip = getClientIP();
                $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';

                $stmt = $db->prepare("INSERT INTO site_visit_logs (ip_address, user_agent) VALUES (:ip, :ua)");
                $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
                $stmt->bindValue(':ua', $ua, SQLITE3_TEXT);
                $stmt->execute();

                $_SESSION['has_visited_site'] = true;
            }
        }
        $result = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'");
        $response['value'] = $result ? $result : 0;
    } elseif ($action === 'view' && !empty($slug)) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug); // Sanitasi
        $sessionKey = 'viewed_' . $slug;
        if ($method === 'POST') {
            if (!isset($_SESSION[$sessionKey])) {
                $stmt = $db->prepare("INSERT INTO post_stats (slug, views) VALUES (:slug, 1) ON CONFLICT(slug) DO UPDATE SET views = views + 1");
                $stmt->bindValue(':slug', $slug, SQLITE3_TEXT);
                $stmt->execute();
                $_SESSION[$sessionKey] = true;
            }
        }
        $stmt = $db->prepare("SELECT views FROM post_stats WHERE slug = :slug");
        $stmt->bindValue(':slug', $slug, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        $response['value'] = $row ? $row['views'] : 0;
    }
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
