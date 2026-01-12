<?php
session_start();
header('Content-Type: application/json');

// Proteksi: Hanya Super Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['user_role'] !== 'super_admin') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Access Denied: Super Admin Only']);
    exit;
}

$dbPath = __DIR__ . '/../../database.db';
try {
    $db = new SQLite3($dbPath);
    $method = $_SERVER['REQUEST_METHOD'];
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // GET ALL USERS
    if ($method === 'GET') {
        $res = $db->query("SELECT id, email, name, picture, role, status, created_at FROM users ORDER BY created_at DESC");
        $users = [];
        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
            $users[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $users]);
    }

    // UPDATE USER (Role & Status)
    elseif ($method === 'POST' && isset($_GET['action']) && $_GET['action'] === 'update') {
        $id = (int)$data['id'];
        $role = $data['role']; // super_admin, operator, user
        $status = $data['status']; // active, inactive

        // Mencegah Super Admin mengubah dirinya sendiri menjadi inactive/user biasa (Anti Lockout)
        if ($id === $_SESSION['user_id'] && ($status !== 'active' || $role !== 'super_admin')) {
            throw new Exception("Anda tidak bisa menurunkan hak akses atau menonaktifkan akun sendiri.");
        }

        $stmt = $db->prepare("UPDATE users SET role = :role, status = :status WHERE id = :id");
        $stmt->bindValue(':role', $role, SQLITE3_TEXT);
        $stmt->bindValue(':status', $status, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'User berhasil diperbarui']);
        } else {
            throw new Exception("Gagal update user.");
        }
    }

    // DELETE USER
    elseif ($method === 'POST' && isset($_GET['action']) && $_GET['action'] === 'delete') {
        $id = (int)$data['id'];

        if ($id === $_SESSION['user_id']) {
            throw new Exception("Tidak bisa menghapus akun sendiri.");
        }

        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'User dihapus permanen.']);
        } else {
            throw new Exception("Gagal menghapus user.");
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
