<?php
// app/controllers/LocationController.php
require_once __DIR__ . '/../models/LocationModel.php';
/**
 * Controller for managing locations.
 * Depends on helper functions:
 * - is_logged_in(), is_approved()
 * - set_flash_message($msg, $type)
 * - get_db()  (PDO connection)
 */

// --------------------------- ADD LOCATION ---------------------
function add_location_page() {
    if (!is_logged_in() || !is_approved()) {
        set_flash_message("You must be logged in and approved to add locations.", "error");
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    // Fetch existing locations for display on the map
    $locations = get_all_locations();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_location'])) {
        $country = trim($_POST['country'] ?? '');
        $state   = trim($_POST['state'] ?? '');
        $county  = trim($_POST['county'] ?? '');
        $city    = trim($_POST['city'] ?? '');
        $lat     = $_POST['lat'] ?? null;
        $lng     = $_POST['lng'] ?? null;

        if ($country && $lat && $lng) {
            save_location($country, $state, $county, $city, $lat, $lng);
            set_flash_message("Location added successfully.", "success");
            header("Location: " . BASE_URL . "/locations/add"); 
            exit;
        } else {
            set_flash_message("Please select a valid location before saving.", "error");
        }
    }

    require __DIR__ . '/../views/locations/add_location.php';
}

// --------------------------- SAVE LOCATION ---------------------
function save_location($country, $state, $county, $city, $lat, $lng) {
    $db = get_db();
    $stmt = $db->prepare("
    INSERT INTO locations (country, state, county, city, name, type, latitude, longitude)
    VALUES (:country, :state, :county, :city, :name, :type, :latitude, :longitude)
");

$stmt->execute([
    ':country'  => $country,
    ':state'    => $state,
    ':county'   => $county,
    ':city'     => $city,
    ':name'     => $city ?: $county ?: $state ?: $country,
    ':type'     => $city ? 'city' : ($county ? 'county' : ($state ? 'state' : 'country')),
    ':latitude' => $lat,
    ':longitude'=> $lng
]);

    return $db->lastInsertId();
}


// --------------------------- GET ALL LOCATIONS ---------------------

function list_locations($db) {
    $locations = get_all_locations($db); // call model function
    require __DIR__ . '/../views/locations.php';
}

