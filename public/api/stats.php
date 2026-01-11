<?php
// public/api/stats.php

// 1. Header Security (CORS Locked ke domain sekolah)
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://mtsn1pandeglang.sch.id');
header('Access-Control-Allow-Methods: GET, POST');

// 2. Mulai Session (Wajib di paling atas sebelum output apapun)
session_start();

// 3. Lokasi Database
// Naik 2 level dari: dist/api/stats.php -> dist/ -> root/stats.db
$dbPath = __DIR__ . '/../../stats.db';

try {
    // Cek driver
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed on PHP");
    }

    $db = new SQLite3($dbPath);

    // Setup Tabel
    $db->exec("CREATE TABLE IF NOT EXISTS global_stats (key TEXT PRIMARY KEY, value INTEGER DEFAULT 0)");
    $db->exec("CREATE TABLE IF NOT EXISTS post_stats (slug TEXT PRIMARY KEY, views INTEGER DEFAULT 0)");

    // Data Awal
    $db->exec("INSERT OR IGNORE INTO global_stats (key, value) VALUES ('site_visits', 0)");

    // Parameter
    $action = $_GET['action'] ?? '';
    $slug   = $_GET['slug'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];

    $response = ['value' => 0];

    // ==========================================
    // LOGIKA 1: TOTAL KUNJUNGAN WEBSITE
    // ==========================================
    if ($action === 'visit') {

        if ($method === 'POST') {
            // SECURITY: Cek Session PHP (Server Side)
            // Jika browser belum punya "tanda" pernah berkunjung, baru kita tambah +1
            if (!isset($_SESSION['has_visited_site'])) {
                $db->exec("UPDATE global_stats SET value = value + 1 WHERE key = 'site_visits'");

                // Beri "tanda" di server bahwa user ini sudah dihitung
                $_SESSION['has_visited_site'] = true;
            }
        }

        // Ambil data terbaru
        $result = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'");
        $response['value'] = $result ? $result : 0;

        // ==========================================
        // LOGIKA 2: PEMBACA ARTIKEL (POST VIEW)
        // ==========================================
    } elseif ($action === 'view' && !empty($slug)) {

        // Sanitasi Slug (Hanya huruf, angka, strip)
        $slug = preg_replace('/[^a-zA-Z0-9_-]/', '', $slug);

        // Buat kunci session unik per artikel, misal: viewed_zona-integritas
        $sessionKey = 'viewed_' . $slug;

        if ($method === 'POST') {
            // SECURITY: Cek Session PHP per Artikel
            if (!isset($_SESSION[$sessionKey])) {
                $stmt = $db->prepare("INSERT INTO post_stats (slug, views) VALUES (:slug, 1) ON CONFLICT(slug) DO UPDATE SET views = views + 1");
                $stmt->bindValue(':slug', $slug, SQLITE3_TEXT);
                $stmt->execute();

                // Tandai bahwa user ini sudah membaca artikel ini
                $_SESSION[$sessionKey] = true;
            }
        }

        // Ambil data terbaru
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
