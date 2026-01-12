<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://mtsn1pandeglang.sch.id');
header('Access-Control-Allow-Methods: GET, POST');
session_start();
$dbPath = __DIR__ . '/../../database.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed on PHP");
    }
    $db = new SQLite3($dbPath);
    $db->exec("CREATE TABLE IF NOT EXISTS global_stats (key TEXT PRIMARY KEY, value INTEGER DEFAULT 0)");
    $db->exec("CREATE TABLE IF NOT EXISTS post_stats (slug TEXT PRIMARY KEY, views INTEGER DEFAULT 0)");
    $db->exec("INSERT OR IGNORE INTO global_stats (key, value) VALUES ('site_visits', 0)");
    $action = $_GET['action'] ?? '';
    $slug   = $_GET['slug'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];

    $response = ['value' => 0];
    if ($action === 'visit') {
        if ($method === 'POST') {
            if (!isset($_SESSION['has_visited_site'])) {
                $db->exec("UPDATE global_stats SET value = value + 1 WHERE key = 'site_visits'");
                $_SESSION['has_visited_site'] = true;
            }
        }
        $result = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'");
        $response['value'] = $result ? $result : 0;
    } elseif ($action === 'view' && !empty($slug)) {
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);
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
