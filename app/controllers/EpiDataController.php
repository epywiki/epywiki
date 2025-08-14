<?php
//app/controllers/EpiDataController.php

function add_disease_report_page() {
    if (!is_logged_in() || !is_approved()) {
        echo "Access denied.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $disease_id = $_POST['disease_id'];
        $location_id = $_POST['location_id'];
        $cases = $_POST['cases'];
        $report_date = $_POST['report_date'];

        if (add_disease_report($disease_id, $location_id, $cases, $report_date)) {
            echo "Report added successfully!";
        } else {
            echo "Error adding report.";
        }
    }

    $diseases = get_all_diseases();
    $locations = get_all_locations();
    require __DIR__ . '/../views/add_disease_report.php'; // ✅ Fixed
}

function edit_epi_data_page() {
    if (!is_logged_in() || !is_approved()) {
        echo "Access denied.";
        return;
    }

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "No record ID provided.";
        return;
    }

    $record = get_epi_data_by_id($id);
    if (!$record) {
        echo "Record not found.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cases = $_POST['cases'] ?? null;
        $deaths = $_POST['deaths'] ?? null;
        $report_date = $_POST['report_date'] ?? null;
        $notes = $_POST['notes'] ?? null;

        update_disease_location_data($id, $cases, $deaths, $report_date, $notes);
        echo "<p style='color:green;'>Data updated successfully.</p>";
        redirect("index.php?page=home&disease_id=" . $record['disease_id']);
    }

    require __DIR__ . '/../views/edit_epi_data.php'; // ✅ Fixed
}
