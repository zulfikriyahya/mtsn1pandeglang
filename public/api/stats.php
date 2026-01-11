<?php
// public/api/stats.php

// Header agar bisa diakses fetch JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

// Lokasi database (Sebaiknya di luar folder public agar tidak bisa didownload orang)
// Asumsi: script ini ada di /var/www/domain/api/stats.php
// Database kita taruh di /var/www/domain/stats.db
$dbPath = __DIR__ . '/../../stats.db';

try {
    // Cek apakah driver SQLite tersedia
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed on PHP");
    }

    $db = new SQLite3($dbPath);

    // Buat tabel jika belum ada
    $db->exec("CREATE TABLE IF NOT EXISTS global_stats (key TEXT PRIMARY KEY, value INTEGER DEFAULT 0)");
    $db->exec("CREATE TABLE IF NOT EXISTS post_stats (slug TEXT PRIMARY KEY, views INTEGER DEFAULT 0)");

    // Inisialisasi visitor awal
    $db->exec("INSERT OR IGNORE INTO global_stats (key, value) VALUES ('site_visits', 0)");

    // Ambil parameter
    $action = $_GET['action'] ?? ''; // 'visit' atau 'view'
    $slug   = $_GET['slug'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];

    $response = ['value' => 0];

    if ($action === 'visit') {
        // --- VISITOR COUNTER ---
        if ($method === 'POST') {
            $db->exec("UPDATE global_stats SET value = value + 1 WHERE key = 'site_visits'");
        }
        $result = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'");
        $response['value'] = $result ? $result : 0;
    } elseif ($action === 'view' && !empty($slug)) {
        // --- POST VIEW COUNTER ---
        // Sanitasi slug sederhana
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);

        if ($method === 'POST') {
            $stmt = $db->prepare("INSERT INTO post_stats (slug, views) VALUES (:slug, 1) ON CONFLICT(slug) DO UPDATE SET views = views + 1");
            $stmt->bindValue(':slug', $slug, SQLITE3_TEXT);
            $stmt->execute();
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
