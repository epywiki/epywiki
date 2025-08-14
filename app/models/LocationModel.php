<?php
// app/models/LocationModel.php
require_once __DIR__ . '/Database.php';

function add_location_to_db($name, $type, $parent_id = null) {
    $stmt = get_db()->prepare("INSERT INTO locations (name, type, parent_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $type, $parent_id]);
    return get_db()->lastInsertId();
}

function get_all_locations() {
    return get_db()->query("SELECT * FROM locations WHERE type = 'ward' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
}

function get_child_locations($parent_id) {
    $stmt = get_db()->prepare("SELECT * FROM locations WHERE parent_id = ?");
    $stmt->execute([$parent_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
