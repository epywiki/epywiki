<?php
// app/controllers/ReportController.php
require_once __DIR__ . '/../models/ReportModel.php';
require_once __DIR__ . '/../models/DiseaseModel.php';
require_once __DIR__ . '/../models/LocationModel.php';



// In ReportController.php
function list_reports_page() {
    $reports = get_all_reports();
    $Parsedown = new Parsedown();
    require __DIR__ . '/../views/reports/report_list.php';
}


function create_report_page() {
    $diseases = get_all_diseases();
    $locations = get_all_locations();
    require __DIR__ . '/../views/reports/create_report.php';
}

function store_report_action() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $disease_id = $_POST['disease_id'];
        $location_id = $_POST['location_id'];
        $content_md = $_POST['content_md'];
        $user_id = 1; // TODO: replace with logged-in user ID

        // Pass them individually
        add_report($disease_id, $location_id, $user_id, $content_md);
    }

    header("Location: " . BASE_URL . "/reports");
    exit;
}

function edit_report_page($id) {
    $report = get_report_by_id($id);  // fetch report from DB
    $diseases = get_all_diseases();
    $locations = get_all_locations();

    if (!$report) {
        set_flash_message("Report not found", "error");
        return;
    }

    require __DIR__ . '/../views/reports/edit_report.php';
}

function delete_report_action($id) {
    if (!$id) {
        set_flash_message("No report ID provided", "error");
        return;
    }

    if (delete_report($id)) {
        // Successfully deleted, redirect back to reports list
        header("Location: " . BASE_URL . "/reports");
        set_flash_message("Disease successfully deleted.", "success");
        exit;
    } else {
        set_flash_message("Failed to delete report.", "error");
    }
}

function update_report_action($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $disease_id = $_POST['disease_id'];
        $location_id = $_POST['location_id'];
        $content_md = $_POST['content_md'];

        // Update the report in DB
        update_report($id, $disease_id, $location_id, $content_md);

        set_flash_message("Report updated successfully", "success");
        header("Location: " . BASE_URL . "/reports");
        exit;
    }
}

