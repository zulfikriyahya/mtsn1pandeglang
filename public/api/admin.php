<?php
session_start();
date_default_timezone_set('Asia/Jakarta'); // Set Timezone Server ke Jakarta

// Proteksi
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$dbPath = __DIR__ . '/../../database.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);
    $action = $_GET['action'] ?? 'stats';

    // === HELPER: Format Tanggal Indonesia ===
    function formatTanggalIndo($timestamp)
    {
        // Asumsi timestamp dari DB adalah UTC, kita konversi ke Jakarta
        try {
            $dt = new DateTime($timestamp, new DateTimeZone('UTC'));
            $dt->setTimezone(new DateTimeZone('Asia/Jakarta'));

            $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            $tgl = $dt->format('d');
            $bln = $bulan[(int)$dt->format('m')];
            $thn = $dt->format('Y');
            $jam = $dt->format('H:i');

            return "$tgl $bln $thn, $jam WIB";
        } catch (Exception $e) {
            return $timestamp;
        }
    }

    // === HELPER: Grafik Harian (Waktu Jakarta) ===
    function getSafeDailyActivity($db, $table, $days = 30)
    {
        $data = [];
        // Generate tanggal 30 hari terakhir (Waktu Jakarta)
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $data[$date] = 0;
        }

        try {
            $check = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$table'");
            if (!$check) return $data;

            // Query dengan penyesuaian Timezone (+7 Jam untuk WIB)
            // datetime(created_at, '+7 hours') mengubah UTC ke WIB sebelum di-group
            $query = "SELECT substr(datetime(created_at, '+7 hours'), 1, 10) as date, COUNT(*) as count
                      FROM $table
                      WHERE created_at >= date('now', '-$days days', '-7 hours')
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
        }
        return $data;
    }

    if ($action === 'stats') {
        header('Content-Type: application/json');

        // 1. Overview Count
        $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;

        $total_posts = 0;
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='post_stats'")) {
            $total_posts = $db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0;
        }

        $total_feedback = 0;
        $stars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='feedback'")) {
            $total_feedback = $db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0;
            $resStar = $db->query("SELECT rating, COUNT(*) as count FROM feedback GROUP BY rating");
            while ($row = $resStar->fetchArray(SQLITE3_ASSOC)) {
                $stars[$row['rating']] = $row['count'];
            }
        }

        $total_survey = 0;
        $survey_avg = ['zi' => 0, 'service' => 0, 'academic' => 0];
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='survey_responses'")) {
            $total_survey = $db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0;
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

        // 5. Raw Data (Dikirim Mentah UTC, diformat di Frontend)
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

    // === EXPORT LOGIC (FORMAT INDONESIA) ===
    elseif ($action === 'export') {
        $type = $_GET['type'] ?? '';
        $filename = "laporan_{$type}_" . date('Y-m-d_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        // Tambahkan BOM untuk Excel agar bisa baca karakter UTF-8 dengan benar
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        if ($type === 'feedback') {
            fputcsv($output, ['ID', 'Waktu (WIB)', 'Nama', 'Rating', 'Pesan', 'IP Address']);
            $res = $db->query("SELECT id, created_at, name, rating, message, ip_address FROM feedback ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($output, $row);
            }
        } elseif ($type === 'survey') {
            fputcsv($output, ['ID', 'Waktu (WIB)', 'Nama', 'Peran', 'Skor ZI', 'Skor Pelayanan', 'Skor Akademik', 'Masukan', 'IP Address']);
            $res = $db->query("SELECT id, created_at, respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, ip_address FROM survey_responses ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($output, $row);
            }
        } elseif ($type === 'posts') {
            fputcsv($output, ['Judul Artikel / Slug', 'Jumlah Pembaca']);
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
