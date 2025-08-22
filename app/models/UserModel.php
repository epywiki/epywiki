<?php
// app/models/UserModel.php
require_once __DIR__ . '/Database.php';

function count_users() {
    return (int) get_db()->query("SELECT COUNT(*) FROM users")->fetchColumn();
}

function get_all_users() {
    return get_db()->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
}

function update_user_status($id, $approved) {
    $stmt = get_db()->prepare("UPDATE users SET is_approved = ? WHERE id = ?");
    $stmt->execute([$approved, $id]);
}

function delete_user($id) {
    $stmt = get_db()->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

function register_user($username, $email, $password, $is_admin = 0, $is_approved = 0) {
    $stmt = get_db()->prepare("
        INSERT INTO users (username, email, password_hash, is_admin, is_approved)
        VALUES (?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
        $username,
        $email,
        password_hash($password, PASSWORD_DEFAULT),
        $is_admin,
        $is_approved
    ]);
}

function get_user_by_email($email) {
    $stmt = get_db()->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function get_user_by_id($id) {
    $stmt = get_db()->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_user_password($id, $new_password) {
    $stmt = get_db()->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    return $stmt->execute([password_hash($new_password, PASSWORD_DEFAULT), $id]);
}

function is_approved() {
    if (!isset($_SESSION['user_id'])) return false;
    $user = get_user_by_id($_SESSION['user_id']);
    return $user && $user['is_approved'] == 1;
}
