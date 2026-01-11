<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$dbPath = __DIR__ . '/../../stats.db';

function getClientIP()
{
    // Handle IP jika di belakang proxy/Cloudflare
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

    // 1. Update Struktur Tabel (Menambahkan kolom ip_address jika belum ada)
    // Kita cek dulu apakah kolom sudah ada, cara simpel: coba query dummy
    $checkTable = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='feedback'");
    if ($checkTable) {
        $cols = $db->query("PRAGMA table_info(feedback)");
        $hasIpCol = false;
        while ($row = $cols->fetchArray()) {
            if ($row['name'] === 'ip_address') $hasIpCol = true;
        }
        if (!$hasIpCol) {
            $db->exec("ALTER TABLE feedback ADD COLUMN ip_address TEXT");
        }
    } else {
        $query = "CREATE TABLE IF NOT EXISTS feedback (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            rating INTEGER NOT NULL,
            message TEXT,
            ip_address TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $db->exec($query);
    }

    // Fungsi Helper untuk ambil stats
    function getStats($db)
    {
        $row = $db->querySingle("SELECT AVG(rating) as average, COUNT(*) as total FROM feedback", true);
        return [
            'average' => round($row['average'] ?? 0, 1),
            'total' => $row['total'] ?? 0
        ];
    }

    // 2. Handle POST (Submit Data)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cek apakah IP sudah pernah submit
        $checkIp = $db->prepare("SELECT id FROM feedback WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();

        if ($res->fetchArray()) {
            echo json_encode(['status' => 'error', 'message' => 'Anda sudah memberikan penilaian sebelumnya.']);
            exit;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['rating'])) throw new Exception("Rating wajib diisi.");

        $name = isset($data['name']) ? htmlspecialchars(strip_tags($data['name'])) : 'Anonim';
        $rating = (int)$data['rating'];
        $message = isset($data['message']) ? htmlspecialchars(strip_tags($data['message'])) : '';

        $stmt = $db->prepare("INSERT INTO feedback (name, rating, message, ip_address) VALUES (:name, :rating, :message, :ip)");
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':rating', $rating, SQLITE3_INTEGER);
        $stmt->bindValue(':message', $message, SQLITE3_TEXT);
        $stmt->bindValue(':ip', $ip_address, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Terima kasih atas penilaian Anda!',
                'stats' => getStats($db)
            ]);
        } else {
            throw new Exception("Gagal menyimpan data.");
        }
    }
    // 3. Handle GET (Cek Status IP & Ambil Stats)
    else {
        $checkIp = $db->prepare("SELECT id FROM feedback WHERE ip_address = :ip");
        $checkIp->bindValue(':ip', $ip_address, SQLITE3_TEXT);
        $res = $checkIp->execute();
        $hasSubmitted = ($res->fetchArray()) ? true : false;

        echo json_encode([
            'status' => 'ready',
            'has_submitted' => $hasSubmitted,
            'stats' => getStats($db)
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
