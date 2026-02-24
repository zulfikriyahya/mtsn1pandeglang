<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

try {
    $pdo    = getDBConnection();
    $action = $_GET['action'] ?? 'stats';

    // --- HELPER: aktivitas harian 30 hari terakhir ---
    function getSafeDailyActivity(PDO $pdo, string $table, int $days = 30): array
    {
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $data[date('Y-m-d', strtotime("-$i days"))] = 0;
        }
        try {
            $stmt = $pdo->prepare("SHOW TABLES LIKE :t");
            $stmt->execute([':t' => $table]);
            if (!$stmt->fetch()) return $data;

            $stmt = $pdo->prepare(
                "SELECT DATE(created_at) as date, COUNT(*) as count
                 FROM $table
                 WHERE created_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
                 GROUP BY DATE(created_at)"
            );
            $stmt->execute([':days' => $days]);
            while ($row = $stmt->fetch()) {
                if (isset($data[$row['date']])) $data[$row['date']] = (int)$row['count'];
            }
        } catch (Exception $e) {
        }
        return $data;
    }

    // --- HELPER: format tanggal Indo ---
    function formatTanggalIndo(string $timestamp): string
    {
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
                'Desember',
            ];
            return $dt->format('d') . ' ' . $bulan[(int)$dt->format('m')] . ' ' . $dt->format('Y') . ', ' . $dt->format('H:i');
        } catch (Exception $e) {
            return $timestamp;
        }
    }

    // ================================================================
    // ACTION: stats
    // ================================================================
    if ($action === 'stats') {
        header('Content-Type: application/json');

        // Parameter filter kunjungan — 0 berarti tidak difilter
        $filterMonth = isset($_GET['visit_month']) ? (int)$_GET['visit_month'] : 0;
        $filterYear  = isset($_GET['visit_year'])  ? (int)$_GET['visit_year']  : 0;

        // Overview — selalu total keseluruhan (tidak terpengaruh filter)
        $visits         = (int)($pdo->query("SELECT value FROM global_stats WHERE `key` = 'site_visits'")->fetchColumn() ?: 0);
        $total_posts    = (int)($pdo->query("SELECT COUNT(*) FROM post_stats")->fetchColumn() ?: 0);
        $total_feedback = (int)($pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn() ?: 0);
        $total_survey   = (int)($pdo->query("SELECT COUNT(*) FROM survey_responses")->fetchColumn() ?: 0);

        // Stars distribution
        $stars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        if ($total_feedback > 0) {
            $stmt = $pdo->query("SELECT rating, COUNT(*) as count FROM feedback GROUP BY rating");
            while ($row = $stmt->fetch()) $stars[(int)$row['rating']] = (int)$row['count'];
        }

        // Survey avg
        $survey_avg = ['zi' => 0, 'service' => 0, 'academic' => 0, 'facilities' => 0, 'management' => 0, 'culture' => 0];
        if ($total_survey > 0) {
            $avg = $pdo->query(
                "SELECT AVG(score_zi) as zi, AVG(score_service) as service,
                        AVG(score_academic) as academic, AVG(score_facilities) as facilities,
                        AVG(score_management) as management, AVG(score_culture) as culture
                 FROM survey_responses"
            )->fetch();
            if ($avg) {
                foreach ($survey_avg as $k => $_) {
                    $survey_avg[$k] = round((float)($avg[$k] ?? 0), 2);
                }
            }
        }

        // Activity charts
        $activity_feedback = getSafeDailyActivity($pdo, 'feedback');
        $activity_survey   = getSafeDailyActivity($pdo, 'survey_responses');

        // Tables
        $posts     = $pdo->query("SELECT slug, views FROM post_stats ORDER BY views DESC")->fetchAll();
        $feedbacks = $pdo->query("SELECT * FROM feedback ORDER BY created_at DESC")->fetchAll();
        $surveys   = $pdo->query("SELECT * FROM survey_responses ORDER BY created_at DESC")->fetchAll();

        // --- Visit logs: filter di SQL ---
        $visitConditions = [];
        $visitParams     = [];

        if ($filterMonth > 0) {
            $visitConditions[] = "MONTH(created_at) = :month";
            $visitParams[':month'] = $filterMonth;
        }
        if ($filterYear > 0) {
            $visitConditions[] = "YEAR(created_at) = :year";
            $visitParams[':year'] = $filterYear;
        }

        $whereClause = $visitConditions
            ? 'WHERE ' . implode(' AND ', $visitConditions)
            : '';

        $visitStmt = $pdo->prepare(
            "SELECT id, ip_address, user_agent, created_at
             FROM site_visit_logs
             $whereClause
             ORDER BY created_at DESC
             LIMIT 2000"
        );
        $visitStmt->execute($visitParams);
        $visit_logs = $visitStmt->fetchAll();

        // Total visit count untuk periode yang difilter (untuk info di frontend)
        $countStmt = $pdo->prepare("SELECT COUNT(*) FROM site_visit_logs $whereClause");
        $countStmt->execute($visitParams);
        $visit_total_filtered = (int)$countStmt->fetchColumn();

        echo json_encode([
            'overview' => [
                'visits'         => $visits,
                'posts_count'    => $total_posts,
                'feedback_count' => $total_feedback,
                'survey_count'   => $total_survey,
            ],
            'charts' => [
                'stars'       => $stars,
                'survey_avg'  => $survey_avg,
                'activity'    => [
                    'labels'   => array_keys($activity_feedback),
                    'feedback' => array_values($activity_feedback),
                    'survey'   => array_values($activity_survey),
                ],
            ],
            'tables' => [
                'posts'     => $posts,
                'feedbacks' => $feedbacks,
                'surveys'   => $surveys,
                'visits'    => $visit_logs,
                // Meta info untuk frontend
                'visits_meta' => [
                    'total_filtered' => $visit_total_filtered,
                    'filter_month'   => $filterMonth,
                    'filter_year'    => $filterYear,
                    'limit'          => 2000,
                ],
            ],
        ]);

        // ================================================================
        // ACTION: export
        // ================================================================
    } elseif ($action === 'export') {
        $type     = $_GET['type'] ?? '';
        $filename = "laporan_{$type}_" . date('Y-m-d_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $out = fopen('php://output', 'w');
        fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8

        if ($type === 'feedback') {
            fputcsv($out, ['ID', 'Waktu (WIB)', 'Nama', 'Rating', 'Pesan', 'IP Address']);
            $stmt = $pdo->query("SELECT id, created_at, name, rating, message, ip_address FROM feedback ORDER BY created_at DESC");
            while ($row = $stmt->fetch()) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($out, $row);
            }
        } elseif ($type === 'survey') {
            fputcsv($out, ['ID', 'Waktu (WIB)', 'Nama', 'Peran', 'ZI', 'Pelayanan', 'Akademik', 'Sarpras', 'Manajemen', 'Budaya', 'Masukan', 'IP Address']);
            $stmt = $pdo->query(
                "SELECT id, created_at, respondent_name, respondent_role,
                        score_zi, score_service, score_academic, score_facilities,
                        score_management, score_culture, feedback, ip_address
                 FROM survey_responses ORDER BY created_at DESC"
            );
            while ($row = $stmt->fetch()) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($out, $row);
            }
        } elseif ($type === 'posts') {
            fputcsv($out, ['Judul Artikel / Slug', 'Jumlah Pembaca']);
            $stmt = $pdo->query("SELECT slug, views FROM post_stats ORDER BY views DESC");
            while ($row = $stmt->fetch()) fputcsv($out, $row);
        } elseif ($type === 'visits') {
            // Export visits: support filter bulan/tahun via query param
            $expMonth = isset($_GET['month']) ? (int)$_GET['month'] : 0;
            $expYear  = isset($_GET['year'])  ? (int)$_GET['year']  : 0;

            $conditions = [];
            $params     = [];
            if ($expMonth > 0) {
                $conditions[] = "MONTH(created_at) = :month";
                $params[':month'] = $expMonth;
            }
            if ($expYear  > 0) {
                $conditions[] = "YEAR(created_at) = :year";
                $params[':year']  = $expYear;
            }

            $where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';
            $stmt  = $pdo->prepare("SELECT id, created_at, ip_address, user_agent FROM site_visit_logs $where ORDER BY created_at DESC");
            $stmt->execute($params);

            fputcsv($out, ['ID', 'Waktu (WIB)', 'IP Address', 'User Agent / Perangkat']);
            while ($row = $stmt->fetch()) {
                $row['created_at'] = formatTanggalIndo($row['created_at']);
                fputcsv($out, $row);
            }
        } else {
            fputcsv($out, ['Error: Tipe export tidak dikenal.']);
        }

        fclose($out);
        exit;
    } else {
        header('Content-Type: application/json');
        throw new Exception('Action tidak dikenal.');
    }
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
