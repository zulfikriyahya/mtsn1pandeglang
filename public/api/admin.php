<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

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

    function formatTanggalIndo($timestamp)
    {
        try {
            $dt = new DateTime($timestamp, new DateTimeZone('UTC'));
            $dt->setTimezone(new DateTimeZone('Asia/Jakarta'));
            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y') . ', ' . $dt->format('H:i');
        } catch (Exception $e) {
            return $timestamp;
        }
    }

    // Helper: Daily Activity
    function getSafeDailyActivity($db, $table, $days = 30)
    {
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $data[$date] = 0;
        }
        try {
            $check = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$table'");
            if (!$check) return $data;
            $query = "SELECT substr(datetime(created_at, '+7 hours'), 1, 10) as date, COUNT(*) as count FROM $table WHERE created_at >= date('now', '-$days days', '-7 hours') GROUP BY date";
            $res = $db->query($query);
            if ($res) {
                while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                    if (isset($data[$row['date']])) $data[$row['date']] = $row['count'];
                }
            }
        } catch (Exception $e) {
        }
        return $data;
    }

    if ($action === 'stats') {
        header('Content-Type: application/json');

        // Overview
        $visits = $db->querySingle("SELECT value FROM global_stats WHERE key = 'site_visits'") ?: 0;
        $total_posts = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='post_stats'") ? ($db->querySingle("SELECT COUNT(*) FROM post_stats") ?: 0) : 0;
        $total_feedback = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='feedback'") ? ($db->querySingle("SELECT COUNT(*) FROM feedback") ?: 0) : 0;
        $total_survey = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='survey_responses'") ? ($db->querySingle("SELECT COUNT(*) FROM survey_responses") ?: 0) : 0;

        // Charts data
        $stars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        if ($total_feedback > 0) {
            $resStar = $db->query("SELECT rating, COUNT(*) as count FROM feedback GROUP BY rating");
            while ($row = $resStar->fetchArray(SQLITE3_ASSOC)) $stars[$row['rating']] = $row['count'];
        }

        // PERBAIKAN: Menambahkan 3 kategori baru ke rata-rata survei
        $survey_avg = [
            'zi' => 0,
            'service' => 0,
            'academic' => 0,
            'facilities' => 0,
            'management' => 0,
            'culture' => 0
        ];

        if ($total_survey > 0) {
            // Cek apakah kolom baru sudah ada sebelum query agar tidak error jika migrasi belum jalan
            $cols = [];
            $resCol = $db->query("PRAGMA table_info(survey_responses)");
            while ($rowC = $resCol->fetchArray(SQLITE3_ASSOC)) $cols[] = $rowC['name'];

            // Build query dinamis
            $selects = ["AVG(score_zi) as zi", "AVG(score_service) as service", "AVG(score_academic) as academic"];

            if (in_array('score_facilities', $cols)) $selects[] = "AVG(score_facilities) as facilities";
            if (in_array('score_management', $cols)) $selects[] = "AVG(score_management) as management";
            if (in_array('score_culture', $cols)) $selects[] = "AVG(score_culture) as culture";

            $sql = "SELECT " . implode(', ', $selects) . " FROM survey_responses";
            $avgQuery = $db->querySingle($sql, true);

            if ($avgQuery) {
                $survey_avg['zi'] = round($avgQuery['zi'] ?? 0, 2);
                $survey_avg['service'] = round($avgQuery['service'] ?? 0, 2);
                $survey_avg['academic'] = round($avgQuery['academic'] ?? 0, 2);
                // Tambahkan mapping untuk kolom baru
                $survey_avg['facilities'] = round($avgQuery['facilities'] ?? 0, 2);
                $survey_avg['management'] = round($avgQuery['management'] ?? 0, 2);
                $survey_avg['culture'] = round($avgQuery['culture'] ?? 0, 2);
            }
        }

        $activity_feedback = getSafeDailyActivity($db, 'feedback');
        $activity_survey = getSafeDailyActivity($db, 'survey_responses');

        // Tables Data
        $posts = [];
        if ($total_posts > 0) {
            $res = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) $posts[] = $row;
        }
        $feedbacks = [];
        if ($total_feedback > 0) {
            $res = $db->query("SELECT * FROM feedback ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) $feedbacks[] = $row;
        }
        $surveys = [];
        if ($total_survey > 0) {
            $res = $db->query("SELECT * FROM survey_responses ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) $surveys[] = $row;
        }

        $visit_logs = [];
        if ($db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='site_visit_logs'")) {
            $res = $db->query("SELECT * FROM site_visit_logs ORDER BY created_at DESC LIMIT 1000");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) $visit_logs[] = $row;
        }

        echo json_encode([
            'overview' => ['visits' => $visits, 'posts_count' => $total_posts, 'feedback_count' => $total_feedback, 'survey_count' => $total_survey],
            'charts' => [
                'stars' => $stars,
                'survey_avg' => $survey_avg,
                'activity' => ['labels' => array_keys($activity_feedback), 'feedback' => array_values($activity_feedback), 'survey' => array_values($activity_survey)]
            ],
            'tables' => [
                'posts' => $posts,
                'feedbacks' => $feedbacks,
                'surveys' => $surveys,
                'visits' => $visit_logs
            ]
        ]);
    } elseif ($action === 'export') {
        $type = $_GET['type'] ?? '';
        $filename = "laporan_{$type}_" . date('Y-m-d_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        if ($type === 'feedback') {
            fputcsv($output, ['ID', 'Waktu (WIB)', 'Nama', 'Rating', 'Pesan', 'IP Address']);
            $res = $db->query("SELECT id, created_at, name, rating, message, ip_address FROM feedback ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($output, $row);
            }
        } elseif ($type === 'survey') {
            // PERBAIKAN: Export mendukung 6 kategori
            // Cek kolom dulu
            $cols = [];
            $resCol = $db->query("PRAGMA table_info(survey_responses)");
            while ($rowC = $resCol->fetchArray(SQLITE3_ASSOC)) $cols[] = $rowC['name'];

            // Build Select
            $selectFields = "id, created_at, respondent_name, respondent_role, score_zi, score_service, score_academic";
            if (in_array('score_facilities', $cols)) $selectFields .= ", score_facilities";
            else $selectFields .= ", 0 as score_facilities";

            if (in_array('score_management', $cols)) $selectFields .= ", score_management";
            else $selectFields .= ", 0 as score_management";

            if (in_array('score_culture', $cols)) $selectFields .= ", score_culture";
            else $selectFields .= ", 0 as score_culture";

            $selectFields .= ", feedback, ip_address";

            fputcsv($output, ['ID', 'Waktu (WIB)', 'Nama', 'Peran', 'ZI', 'Pelayanan', 'Akademik', 'Sarpras', 'Manajemen', 'Budaya', 'Masukan', 'IP Address']);

            $res = $db->query("SELECT $selectFields FROM survey_responses ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($output, $row);
            }
        } elseif ($type === 'posts') {
            fputcsv($output, ['Judul Artikel / Slug', 'Jumlah Pembaca']);
            $res = $db->query("SELECT slug, views FROM post_stats ORDER BY views DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) fputcsv($output, $row);
        } elseif ($type === 'visits') {
            fputcsv($output, ['ID', 'Waktu (WIB)', 'IP Address', 'User Agent / Perangkat']);
            $res = $db->query("SELECT id, created_at, ip_address, user_agent FROM site_visit_logs ORDER BY created_at DESC");
            while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($output, $row);
            }
        }
        fclose($output);
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
