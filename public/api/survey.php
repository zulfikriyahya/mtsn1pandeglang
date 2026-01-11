<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

$dbPath = __DIR__ . '/../../stats.db';

try {
    if (!class_exists('SQLite3')) {
        throw new Exception("SQLite3 driver not installed.");
    }

    $db = new SQLite3($dbPath);

    // 1. Buat tabel survey_responses
    // Kita simpan skor per kategori untuk memudahkan reporting nanti
    $query = "CREATE TABLE IF NOT EXISTS survey_responses (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        respondent_name TEXT,
        respondent_role TEXT,
        score_zi REAL,       -- Skor Zona Integritas
        score_service REAL,  -- Skor Pelayanan
        score_academic REAL, -- Skor Akademik
        feedback TEXT,
        details_json TEXT,   -- Detail jawaban per butir soal
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $db->exec($query);

    // 2. Handle POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Validasi dasar
        if (empty($data['answers'])) {
            throw new Exception("Data jawaban kosong.");
        }

        $name = htmlspecialchars(strip_tags($data['profile']['name'] ?? 'Anonim'));
        $role = htmlspecialchars(strip_tags($data['profile']['role'] ?? 'Umum'));
        $feedback = htmlspecialchars(strip_tags($data['feedback'] ?? ''));

        // Hitung skor rata-rata per kategori dari data yang dikirim frontend
        $scoreZi = $data['scores']['zi'] ?? 0;
        $scoreService = $data['scores']['service'] ?? 0;
        $scoreAcademic = $data['scores']['academic'] ?? 0;

        $details = json_encode($data['answers']); // Simpan detail jawaban mentah

        $stmt = $db->prepare("INSERT INTO survey_responses 
            (respondent_name, respondent_role, score_zi, score_service, score_academic, feedback, details_json) 
            VALUES (:name, :role, :zi, :service, :academic, :feedback, :details)");

        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':role', $role, SQLITE3_TEXT);
        $stmt->bindValue(':zi', $scoreZi, SQLITE3_FLOAT);
        $stmt->bindValue(':service', $scoreService, SQLITE3_FLOAT);
        $stmt->bindValue(':academic', $scoreAcademic, SQLITE3_FLOAT);
        $stmt->bindValue(':feedback', $feedback, SQLITE3_TEXT);
        $stmt->bindValue(':details', $details, SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Survei berhasil dikirim. Terima kasih!']);
        } else {
            throw new Exception("Gagal menyimpan data ke database.");
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
