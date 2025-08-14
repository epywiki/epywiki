<?php
//app/controllers/HomeController.php
// ------------------------- HOME -------------------------
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../Parsedown.php';

$Parsedown = new Parsedown();

function home_page() {
    global $Parsedown;

    // Get diseases and locations
    $diseases = get_all_diseases();
    $locations = get_all_wards_with_hierarchy();

     // Get selected disease ID from query parameter
    $selected_disease_id = isset($_GET['disease_id']) ? (int)$_GET['disease_id'] : null;
    
    // Handle form submission (Add Epidemiological Data)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_epi_data'])) {
        $disease_id = (int)$_POST['disease_id'];
        $location_id = (int)$_POST['location_id'];
        $cases = (int)$_POST['cases'];
        $deaths = (int)$_POST['deaths'];
        $report_date = $_POST['report_date'];
        $notes = $_POST['notes'];

        // Add new epidemiological data
        add_disease_location_data($disease_id, $location_id, $cases, $deaths, $report_date, $notes);

        // Redirect to avoid form resubmission
        redirect("index.php?page=home&disease_id=$disease_id");
    }

    // Get selected disease
    $selected_disease_id = isset($_GET['disease_id']) ? (int)$_GET['disease_id'] : null;

    // Fetch epidemiology data for the selected disease
    $epi_data = [];
    if ($selected_disease_id) {
        foreach ($locations as $location) {
            $data = get_epi_data_by_location_and_disease($location['ward_id'], $selected_disease_id);
            $epi_data[$location['ward_id']] = $data ?: null;
        }
    }

    // Load the view
    require __DIR__ . '/../views/home.php';
}
