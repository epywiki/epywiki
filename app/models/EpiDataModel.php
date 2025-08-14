<?php
// app/models/EpiDataModel.php
require_once __DIR__ . '/Database.php';

function add_disease_report($disease_id, $location_id, $cases, $report_date) {
    $stmt = get_db()->prepare("
        INSERT INTO disease_reports (disease_id, location_id, cases, report_date)
        VALUES (?, ?, ?, ?)
    ");
    return $stmt->execute([$disease_id, $location_id, $cases, $report_date]);
}

function get_cases_by_location($disease_id, $level_type) {
    $stmt = get_db()->prepare("
        SELECT l.name, SUM(dr.cases) as total_cases
        FROM disease_reports dr
        JOIN locations l ON dr.location_id = l.id
        WHERE dr.disease_id = ? AND l.type = ?
        GROUP BY l.id
        ORDER BY total_cases DESC
    ");
    $stmt->execute([$disease_id, $level_type]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function link_disease_to_location($disease_id, $location_id) {
    $stmt = get_db()->prepare("INSERT INTO disease_location (disease_id, location_id) VALUES (?, ?)");
    return $stmt->execute([$disease_id, $location_id]);
}
/*
function add_disease_location_data($disease_id, $location_id, $cases, $deaths, $report_date, $notes) {
    $stmt = get_db()->prepare("
        INSERT INTO disease_location_data (disease_id, location_id, cases, deaths, report_date, notes)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([$disease_id, $location_id, $cases, $deaths, $report_date, $notes]);
}
*/
function get_epi_data_by_location($location_id) {
    $stmt = get_db()->prepare("
        SELECT dl.disease_id, d.name AS disease_name, dl.cases, dl.deaths, dl.report_date, dl.notes
        FROM disease_location_data dl
        JOIN diseases d ON dl.disease_id = d.id
        WHERE dl.location_id = ?
        ORDER BY dl.report_date DESC
    ");
    $stmt->execute([$location_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/*
function get_epi_data_by_location_and_disease($location_id, $disease_id) {
    $stmt = get_db()->prepare("
        SELECT dl.*, d.name AS disease_name
        FROM disease_location_data dl
        JOIN diseases d ON dl.disease_id = d.id
        WHERE dl.location_id = ? AND dl.disease_id = ?
        ORDER BY dl.report_date DESC
        LIMIT 1
    ");
    $stmt->execute([$location_id, $disease_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
*/
function get_epi_data_by_id($id) {
    $stmt = get_db()->prepare("SELECT * FROM disease_location_data WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_disease_location_data($id, $cases, $deaths, $report_date, $notes) {
    $stmt = get_db()->prepare("
        UPDATE disease_location_data
        SET cases = ?, deaths = ?, report_date = ?, notes = ?
        WHERE id = ?
    ");
    return $stmt->execute([$cases, $deaths, $report_date, $notes, $id]);
}



function add_disease_location_data($disease_id, $location_id, $cases, $deaths, $report_date, $notes) {
    $stmt = get_db()->prepare("
        INSERT INTO disease_location_data 
        (disease_id, location_id, cases, deaths, report_date, notes)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([$disease_id, $location_id, $cases, $deaths, $report_date, $notes]);
}

function get_epi_data_by_location_and_disease($location_id, $disease_id) {
    $stmt = get_db()->prepare("
        SELECT dl.*, d.name AS disease_name
        FROM disease_location_data dl
        JOIN diseases d ON dl.disease_id = d.id
        WHERE dl.location_id = ? AND dl.disease_id = ?
        ORDER BY dl.report_date DESC
        LIMIT 1
    ");
    $stmt->execute([$location_id, $disease_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
