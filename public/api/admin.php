<?php
session_start();

// Proteksi
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);
    $action = $_GET['action'] ?? 'stats';

    // === HELPER: AMAN DARI ERROR SQLITE VERSION ===
    function getSafeDailyActivity($db, $table, $days = 30)
    {
        $data = [];
        // 1. Buat array tanggal kosong via PHP (Lebih aman)
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $data[$date] = 0;
        }

        // 2. Query simpel
        try {
            // Cek dulu apakah tabel ada
            $check = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$table'");
            if (!$check) return $data;

            // Query data
            $query = "SELECT substr(created_at, 1, 10) as date, COUNT(*) as count 
                      FROM $table 
                      WHERE created_at >= date('now', '-$days days') 
                      GROUP BY date";

            $res = $db->query($query);
            if ($res) {
                while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                    if (isset($data[$row['date']])) {
                        $data[$row['date']] = $row['count'];
                    }
                }
            }
        } catch (Exception $e) {
            // Ignore error di chart agar dashboard tetap jalan
        }
        return $data;
    }

    if ($action === 'stats') {
        header('Content-Type: application/json');

        // 1. Overview Count (Pakai try catch per item biar aman)
        $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;

        $total_posts = 0;
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='post_stats'")) {
            $total_posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0;
        }

        $total_feedback = 0;
        $stars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='feedback'")) {
            $total_feedback = $db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0;
            // Stars
            $resStar = $db->query("SELECT rating, COUNT(*) as count FROM feedback GROUP BY rating");
            while ($row = $resStar->fetchArray(SQLITE3_ASSOC)) {
                $stars[$row['rating']] = $row['count'];
            }
        }

        $total_survey = 0;
        $survey_avg = ['zi' => 0, 'service' => 0, 'academic' => 0];
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='survey_responses'")) {
            $total_survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0;
            // Avg
            $avgQuery = $db->querySingle("SELECT AVG(score_zi) as zi, AVG(score_service) as service, AVG(score_academic) as academic FROM survey_responses", true);
            if ($avgQuery) {
                $survey_avg['zi'] = round($avgQuery['zi'] ?? 0, 2);
                $survey_avg['service'] = round($avgQuery['service'] ?? 0, 2);
                $survey_avg['academic'] = round($avgQuery['academic'] ?? 0, 2);
            }
        }

        // 4. Activity Trends
        $activity_feedback = getSafeDailyActivity($db, 'feedback');
        $activity_survey = getSafeDailyActivity($db, 'survey_responses');

        // 5. Raw Data
        $posts = [];
        if ($total_posts > 0) {
            $resPost = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC");
            while ($row = $resPost->fetchArray(SQLITE3_ASSOC)) $posts[] = $row;
        }

        $feedbacks = [];
        if ($total_feedback > 0) {
            $resFeed = $db->query("SELECT * FROM feedback ORDER BY created_at DESC");
            while ($row = $resFeed->fetchArray(SQLITE3_ASSOC)) $feedbacks[] = $row;
        }

        $surveys = [];
        if ($total_survey > 0) {
            $resSurv = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC");
            while ($row = $resSurv->fetchArray(SQLITE3_ASSOC)) $surveys[] = $row;
        }

        echo json_encode([
            'overview' => [
                'visits' => $visits,
                'posts_count' => $total_posts,
                'feedback_count' => $total_feedback,
                'survey_count' => $total_survey
            ],
            'charts' => [
                'stars' => $stars,
                'survey_avg' => $survey_avg,
                'activity' => [
                    'labels' => array_keys($activity_feedback),
                    'feedback' => array_values($activity_feedback),
                    'survey' => array_values($activity_survey)
                ]
            ],
            'tables' => [
                'posts' => $posts,
                'feedbacks' => $feedbacks,
                'surveys' => $surveys
            ]
        ]);
    }

    // === EXPORT LOGIC ===
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
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
