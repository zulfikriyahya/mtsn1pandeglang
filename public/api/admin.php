<?php
session_start();

// Proteksi
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';
$db = new SQLite3($dbPath);
$action = $_GET['action'] ?? 'stats';

// === HELPER FUNCTION: GROUP BY DATE (SQLite) ===
function getDailyActivity($db, $table)
{
    $data = [];
    // Ambil data 7 hari terakhir
    $query = "SELECT strftime('%Y-%m-%d', created_at) as date, COUNT(*) as count 
              FROM $table 
              WHERE created_at >= date('now', '-7 days') 
              GROUP BY date 
              ORDER BY date ASC";
    $res = $db->query($query);
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $data[$row['date']] = $row['count'];
    }
    return $data;
}

if ($action === 'stats') {
    header('Content-Type: application/json');

    // 1. Overview Count
    $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
    $total_posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0;
    $total_feedback = $db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0;
    $total_survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0;

    // 2. Rating Distribution (Untuk Pie Chart)
    $stars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    $resStar = $db->query("SELECT rating, COUNT(*) as count FROM feedback GROUP BY rating");
    while ($row = $resStar->fetchArray(SQLITE3_ASSOC)) {
        $stars[$row['rating']] = $row['count'];
    }

    // 3. Survey Averages (Untuk Bar Chart)
    $survey_avg = $db->querySingle("SELECT AVG(score_zi) as zi, AVG(score_service) as service, AVG(score_academic) as academic FROM survey_responses", true);

    // 4. Activity Trends (Untuk Line Chart)
    $activity_feedback = getDailyActivity($db, 'feedback');
    $activity_survey = getDailyActivity($db, 'survey_responses');

    // 5. Raw Data (Tables)
    $posts = [];
    $resPost = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC LIMIT 20");
    while ($row = $resPost->fetchArray(SQLITE3_ASSOC)) $posts[] = $row;

    $feedbacks = [];
    $resFeed = $db->query("SELECT * FROM feedback ORDER BY created_at DESC LIMIT 100");
    while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) $feedbacks[] = $row;

    $surveys = [];
    $resSurv = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC LIMIT 100");
    while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) $surveys[] = $row;

    echo json_encode([
        'overview' => [
            'visits' => $visits,
            'posts_count' => $total_posts,
            'feedback_count' => $total_feedback,
            'survey_count' => $total_survey
        ],
        'charts' => [
            'stars' => $stars,
            'survey_avg' => [
                'zi' => round($survey_avg['zi'] ?? 0, 2),
                'service' => round($survey_avg['service'] ?? 0, 2),
                'academic' => round($survey_avg['academic'] ?? 0, 2),
            ],
            'activity' => [
                'feedback' => $activity_feedback,
                'survey' => $activity_survey
            ]
        ],
        'tables' => [
            'posts' => $posts,
            'feedbacks' => $feedbacks,
            'surveys' => $surveys
        ]
    ]);
}

// === EXPORT LOGIC (SAMA SEPERTI SEBELUMNYA) ===
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
