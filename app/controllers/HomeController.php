<?php
//app/controllers/HomeController.php
/**
 *  * the set_flash_message() is found in the app/functions.php with the html in flash_message.php with the related css in public/css/style.css
 * 
 */
// ------------------------- HOME -------------------------
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../Parsedown.php';
require_once __DIR__ . '/../models/LocationModel.php'; // ✅ load the model


$Parsedown = new Parsedown();

function home_page() {
    global $Parsedown;

    // Get diseases and locations
    $diseases = get_all_diseases();
    $locations = get_all_locations();

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

        
        // Redirect to home with disease_id
         redirect(BASE_URL . '/?disease_id=' . $disease_id);
    }

    // Get selected disease
    $selected_disease_id = isset($_GET['disease_id']) ? (int)$_GET['disease_id'] : null;

   

    // Load the view
    require __DIR__ . '/../views/home.php';
}
