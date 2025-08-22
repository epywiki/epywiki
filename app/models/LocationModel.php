<?php
// app/models/LocationModel.php
require_once __DIR__ . '/Database.php';

function add_location_to_db($name, $type, $parent_id = null) {
    $stmt = get_db()->prepare("INSERT INTO locations (name, type, parent_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $type, $parent_id]);
    return get_db()->lastInsertId();
}

// fetches all locations added in add_location.php thanks to nominatim.org and osm . public/js/map.js
function get_all_locations() {
    $db = get_db();
    $stmt = $db->query("SELECT id, name, type, parent_id, latitude, longitude FROM locations");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}





function get_child_locations($parent_id) {
    $stmt = get_db()->prepare("SELECT * FROM locations WHERE parent_id = ?");
    $stmt->execute([$parent_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get a location's ID by its name (and optionally its parent_id). 
function get_location_id_by_name($name, $parent_id = null) {
    $db = get_db();

    if ($parent_id) {
        $stmt = $db->prepare("SELECT id FROM locations WHERE name = :name AND parent_id = :parent_id LIMIT 1");
        $stmt->execute([':name' => $name, ':parent_id' => $parent_id]);
    } else {
        $stmt = $db->prepare("SELECT id FROM locations WHERE name = :name LIMIT 1");
        $stmt->execute([':name' => $name]);
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['id'] : null;
}
