<?php
// app/models/DiseaseModel.php
require_once __DIR__ . '/Database.php';

function add_disease_to_db($name, $description) {
    $stmt = get_db()->prepare("INSERT INTO diseases (name, description) VALUES (?, ?)");
    return $stmt->execute([$name, $description]);
}

function get_all_diseases() {
    return get_db()->query("SELECT * FROM diseases ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
}

function get_disease_by_id($id) {
    $stmt = get_db()->prepare("SELECT * FROM diseases WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_disease_in_db($id, $name, $description) {
    $stmt = get_db()->prepare("UPDATE diseases SET name = ?, description = ? WHERE id = ?");
    return $stmt->execute([$name, $description, $id]);
}

function delete_disease_from_db($id) {
    $stmt = get_db()->prepare("DELETE FROM diseases WHERE id = ?");
    return $stmt->execute([$id]);
}
