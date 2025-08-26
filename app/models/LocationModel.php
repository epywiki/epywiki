<?php
// app/models/LocationModel.php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../config.php';

function add_location($data) {
    $db = get_db();
    $stmt = $db->prepare("
        INSERT INTO locations (country, level1, level2, level3)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
        $data['country'],
        $data['level1'] ?? null,
        $data['level2'] ?? null,
        $data['level3'] ?? null
    ]);
    return $db->lastInsertId();
}

function get_all_locations() {
    $db = get_db();
    $stmt = $db->query("SELECT * FROM locations");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_location($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM locations WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_location($id, $data) {
    $db = get_db();
    $stmt = $db->prepare("
        UPDATE locations 
        SET country = ?, level1 = ?, level2 = ?, level3 = ?
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['country'],
        $data['level1'] ?? null,
        $data['level2'] ?? null,
        $data['level3'] ?? null,
        $id
    ]);
}

function delete_location($id) {
    $db = get_db();
    $stmt = $db->prepare("DELETE FROM locations WHERE id = ?");
    return $stmt->execute([$id]);
}
