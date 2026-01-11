<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Sesuaikan domain jika perlu
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Path database (menggunakan database yang sama dengan stats)
$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("Driver SQLite3 belum diaktifkan di PHP server.");
    }

    $db = new SQLite3($dbPath);

    // 1. Buat tabel feedback jika belum ada
    $query = "CREATE TABLE IF NOT EXISTS feedback (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        rating INTEGER NOT NULL,
        message TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $db->exec($query);

    // 2. Tangani Request POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data JSON dari body request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['rating'])) {
            throw new Exception("Rating wajib diisi.");
        }

        $name = isset($data['name']) ? htmlspecialchars(strip_tags($data['name'])) : 'Anonim';
        $rating = (int)$data['rating'];
        $message = isset($data['message']) ? htmlspecialchars(strip_tags($data['message'])) : '';

        // Validasi rating 1-5
        if ($rating < 1 || $rating > 5) {
            throw new Exception("Rating harus antara 1 sampai 5.");
        }

        // Insert ke Database menggunakan Prepared Statement (Aman dari SQL Injection)
        $stmt = $db->prepare("INSERT INTO feedback (name, rating, message) VALUES (:name, :rating, :message)");
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':rating', $rating, SQLITE3_INTEGER);
        $stmt->bindValue(':message', $message, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Terima kasih atas penilaian Anda!']);
        } else {
            throw new Exception("Gagal menyimpan data.");
        }
    } else {
        // Jika dibuka langsung di browser (bukan POST)
        echo json_encode(['status' => 'ready', 'message' => 'Feedback API is ready.']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
