<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$dbPath = __DIR__ . '/../../database.db';

function getClientIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);
    $ip_address = getClientIP();

    // 1. Update Struktur Tabel (Add ip_address)
    $checkTable = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='survey_responses'");
    if ($checkTable) {
        $cols = $db->query("PRAGMA table_info(survey_responses)");
        $hasIpCol = false;
        while ($row = $cols->fetchArray()) {
            if ($row['name'] === 'ip_address') $hasIpCol = true;
        }
        if (!$hasIpCol) {
            $db->exec("ALTER TABLE survey_responses ADD COLUMN ip_address TEXT");
        }
    } else {
        $query = "CREATE TABLE IF NOT EXISTS survey_responses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            respondent_name TEXT,
            respondent_role TEXT,
            score_zi REAL,
            score_service REAL,
            score_academic REAL,
            feedback TEXT,
            details_json TEXT,
            ip_address TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($query);
    }

    // Helper Stats
    function getSurveyStats($db)
    {
        $sql = "SELECT
            AVG(score_zi) as zi,
            AVG(score_service) as service,
            AVG(score_academic) as academic,
            COUNT(*) as total
            FROM survey_responses";
        $row = $db->querySingle($sql, true);

        return [
            'zi' => round($row['zi'] ?? 0, 1),
            'service' => round($row['service'] ?? 0, 1),
            'academic' => round($row['academic'] ?? 0, 1),
            'total' => $row['total'] ?? 0
        ];
    }

    // 2. Handle POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cek IP
        $checkIp = $db->prepare("SELECT id FROM survey_responses WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();

        if ($res->fetchArray()) {
            echo json_encode(['status' => 'error', 'message' => 'Anda sudah mengisi survei ini.']);
            exit;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (empty($data['answers'])) throw new Exception("Data jawaban kosong.");

        $name = htmlspecialchars(strip_tags($data['profile']['name'] ?? 'Anonim'));
        $role = htmlspecialchars(strip_tags($data['profile']['role'] ?? 'Umum'));
        $feedback = htmlspecialchars(strip_tags($data['feedback'] ?? ''));
        $scoreZi = $data['scores']['zi'] ?? 0;
        $scoreService = $data['scores']['service'] ?? 0;
        $scoreAcademic = $data['scores']['academic'] ?? 0;
        $details = json_encode($data['answers']);

        $stmt = $db->prepare("INSERT INTO survey_responses
            (respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, details_json, ip_address)
            VALUES (:name, :role, :zi, :service, :academic, :feedback, :details, :ip)");

        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':role', $role, SQLITE3_TEXT);
        $stmt->bindValue(':zi', $scoreZi, SQLITE3_FLOAT);
        $stmt->bindValue(':service', $scoreService, SQLITE3_FLOAT);
        $stmt->bindValue(':academic', $scoreAcademic, SQLITE3_FLOAT);
        $stmt->bindValue(':feedback', $feedback, SQLITE3_TEXT);
        $stmt->bindValue(':details', $details, SQLITE3_TEXT);
        $stmt->bindValue(':ip', $ip_address, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Survei berhasil dikirim.',
                'stats' => getSurveyStats($db)
            ]);
        } else {
            throw new Exception("Gagal menyimpan data.");
        }
    }
    // 3. Handle GET
    else {
        $checkIp = $db->prepare("SELECT id FROM survey_responses WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();
        $hasSubmitted = ($res->fetchArray()) ? true : false;

        echo json_encode([
            'status' => 'ready',
            'has_submitted' => $hasSubmitted,
            'stats' => getSurveyStats($db)
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
