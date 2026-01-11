<?php
session_start();

// Proteksi: Hanya admin yang boleh akses
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';
$db = new SQLite3($dbPath);
$action = $_GET['action'] ?? 'stats';

// === AMBIL SEMUA DATA STATISTIK ===
if ($action === 'stats') {
    header('Content-Type: application/json');

    // 1. Visitors
    $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;

    // 2. Artikel Terpopuler
    $posts = [];
    $resPost = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC LIMIT 10");
    while ($row = $resPost->fetchArray(SQLITE3_ASSOC)) $posts[] = $row;

    // 3. Rating Feedback
    $ratings = [];
    $resRate = $db->query("SELECT * FROM feedback ORDER BY created_at DESC LIMIT 50");
    while ($row = $resRate->fetchArray(SQLITE3_ASSOC)) $ratings[] = $row;

    // 4. Survey
    $surveys = [];
    $resSurv = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC LIMIT 50");
    while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) {
        // Decode JSON details agar bisa dibaca frontend jika perlu
        $row['details'] = json_decode($row['details_json'], true);
        unset($row['details_json']);
        $surveys[] = $row;
    }

    echo json_encode([
        'visits' => $visits,
        'posts' => $posts,
        'ratings' => $ratings,
        'surveys' => $surveys
    ]);
}

// === EXPORT KE EXCEL (CSV) ===
elseif ($action === 'export') {
    $type = $_GET['type'] ?? '';
    $filename = "laporan_{$type}_" . date('Y-m-d') . ".csv";

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    if ($type === 'feedback') {
        fputcsv($output, ['ID', 'Nama', 'Rating', 'Pesan', 'IP Address', 'Tanggal']);
        $res = $db->query("SELECT id, name, rating, message, ip_address, created_at FROM feedback ORDER BY created_at DESC");
        while ($row = $res->fetchArray(SQLITE3_ASSOC)) fputcsv($output, $row);
    } elseif ($type === 'survey') {
        fputcsv($output, ['ID', 'Nama', 'Peran', 'Skor ZI', 'Skor Pelayanan', 'Skor Akademik', 'Masukan', 'IP Address', 'Tanggal']);
        $res = $db->query("SELECT id, respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, ip_address, created_at FROM survey_responses ORDER BY created_at DESC");
        while ($row = $res->fetchArray(SQLITE3_ASSOC)) fputcsv($output, $row);
    } elseif ($type === 'posts') {
        fputcsv($output, ['Slug Artikel', 'Jumlah Pembaca']);
        $res = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC");
        while ($row = $res->fetchArray(SQLITE3_ASSOC)) fputcsv($output, $row);
    }

    fclose($output);
    exit;
}
