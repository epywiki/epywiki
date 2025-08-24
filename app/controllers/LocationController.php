<?php
// app/controllers/LocationController.php
require_once __DIR__ . '/../models/LocationModel.php';

/**
 * Controller for managing locations dynamically according to africa.json
 * Depends on:
 * - is_logged_in(), is_approved()
 * - set_flash_message($msg, $type)
 * - get_db()
 */

// --------------------------- ADD LOCATION ---------------------
function add_location_page() {
    if (!is_logged_in() || !is_approved()) {
        set_flash_message("You must be logged in and approved to add locations.", "error");
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    $locations = get_all_locations(); // Fetch existing locations for display

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_location'])) {
        $country = trim($_POST['country'] ?? '');
        $levels  = [
            'level1' => trim($_POST['level1'] ?? ''),
            'level2' => trim($_POST['level2'] ?? ''),
            'level3' => trim($_POST['level3'] ?? '')
        ];

        // Only check if country is set
        if ($country) {
            // Pass structured data to model (controller doesn't care about DB fields)
            $locationData = [
                'country' => $country,
                'levels'  => $levels
            ];

            $locationId = add_location($locationData); // Model handles DB

            set_flash_message("Location added successfully.", "success");
            header("Location: " . BASE_URL . "/locations/add");
            exit;
        } else {
            set_flash_message("Please contact admin.", "error");
        }
    }

    require __DIR__ . '/../views/locations/add_location.php';
}
