<?php
//app/controllers/LocationController.php

//--------------------------- ADD LOCATION ---------------------
function add_location() {
    if (!is_logged_in() || !is_approved()) {
        echo "You must be logged in and approved to add locations.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $county = $_POST['county'] ?? null;
        $constituency = $_POST['constituency'] ?? null;
        $ward = $_POST['ward'] ?? null;

        if ($county) {
            $county_id = add_location_to_db($county, 'county');

            if ($constituency) {
                $constituency_id = add_location_to_db($constituency, 'constituency', $county_id);

                if ($ward) {
                    add_location_to_db($ward, 'ward', $constituency_id);
                }
            }
            echo "<p>Location hierarchy added successfully!</p>";
        } else {
            echo "<p>Please select at least a county.</p>";
        }
    }

    //  Corrected path
    require __DIR__ . '/../views/add_location.php';
}


function add_location_page() {
    if (!is_logged_in() || !is_approved()) {
        echo "You must be logged in and approved to add locations.";
        return;
    }

    $diseases = get_all_diseases();
    $locations = get_all_locations();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Add location
        if (isset($_POST['add_location'])) {
            $county = $_POST['county'] ?? '';
            $constituency = $_POST['constituency'] ?? '';
            $ward = $_POST['ward'] ?? '';

            // Example: Add county if not exists
            add_location_to_db($county, 'county');
            $county_id = get_location_id_by_name($county);

            add_location_to_db($constituency, 'constituency', $county_id);
            $constituency_id = get_location_id_by_name($constituency, $county_id);

            add_location_to_db($ward, 'ward', $constituency_id);

            echo "<p style='color:green;'>Location added successfully!</p>";
        }

        // Add epidemiological data
        if (isset($_POST['add_epi_data'])) {
            $disease_id = $_POST['disease_id'];
            $location_id = $_POST['location_id'];
            $cases = $_POST['cases'] ?? null;
            $deaths = $_POST['deaths'] ?? null;
            $report_date = $_POST['report_date'] ?? null;
            $notes = $_POST['notes'] ?? null;

            add_disease_location_data($disease_id, $location_id, $cases, $deaths, $report_date, $notes);
            echo "<p style='color:green;'>Epidemiological data saved successfully.</p>";
        }
    }

    require __DIR__ . '/../views/add_location.php';

}

function get_all_wards_with_hierarchy() {
    $db = get_db();
    $stmt = $db->query("
        SELECT w.id AS ward_id, w.name AS ward_name,
               c.name AS constituency_name, co.name AS county_name
        FROM locations w
        JOIN locations c ON w.parent_id = c.id AND c.type = 'constituency'
        JOIN locations co ON c.parent_id = co.id AND co.type = 'county'
        WHERE w.type = 'ward'
        ORDER BY w.name ASC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
