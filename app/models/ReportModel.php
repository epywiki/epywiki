<?php
// app/models/ReportModel.php
require_once __DIR__ . '/Database.php';

function add_report($disease_id, $location_id, $user_id, $content_md) {
    $db = get_db();
    $stmt = $db->prepare("
        INSERT INTO reports (disease_id, location_id, user_id, content_md) 
        VALUES (?, ?, ?, ?)
    ");
    return $stmt->execute([$disease_id, $location_id, $user_id, $content_md]);
}

function get_all_reports() {
    $db = get_db();
    $stmt = $db->query("
        SELECT 
            r.*, 
            d.name AS disease_name, 
            d.description AS disease_description, 
            l.country, l.level1, l.level2, l.level3,
            u.username
        FROM reports r
        JOIN diseases d ON r.disease_id = d.id
        JOIN locations l ON r.location_id = l.id
        JOIN users u ON r.user_id = u.id
        ORDER BY r.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function get_report($id) {
    $db = get_db();
    $stmt = $db->prepare("
        SELECT r.*, d.name AS disease_name, l.country, u.username
        FROM reports r
        JOIN diseases d ON r.disease_id = d.id
        JOIN locations l ON r.location_id = l.id
        JOIN users u ON r.user_id = u.id
        WHERE r.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function update_report($id, $disease_id, $location_id, $content_md) {
    $db = get_db();
    $stmt = $db->prepare("
        UPDATE reports 
        SET disease_id = ?, location_id = ?, content_md = ? 
        WHERE id = ?
    ");
    return $stmt->execute([$disease_id, $location_id, $content_md, $id]);
}


function delete_report($id) {
    $db = get_db();
    $stmt = $db->prepare("DELETE FROM reports WHERE id = ?");
    return $stmt->execute([$id]);
}

function get_report_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM reports WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
