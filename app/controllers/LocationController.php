<?php
// app/controllers/LocationController.php
require_once __DIR__ . '/../models/LocationModel.php';

function add_location_page() {
    if (!is_logged_in() || !is_approved()) {
        set_flash_message("You must be logged in and approved to add locations.", "error");
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_location'])) {
        $country = trim($_POST['country'] ?? '');
        $level1  = trim($_POST['level1'] ?? '');
        $level2  = trim($_POST['level2'] ?? '');
        $level3  = trim($_POST['level3'] ?? '');

        if ($country) {
            $locationData = [
                'country' => $country,
                'level1'  => $level1,
                'level2'  => $level2,
                'level3'  => $level3
            ];
            add_location($locationData);

            set_flash_message("Location added successfully.", "success");
            header("Location: " . BASE_URL . "/");
            exit;
        } else {
            set_flash_message("Please select a country.", "error");
        }
    }

    require __DIR__ . '/../views/locations/add_location.php';
}

function edit_location_page($id) {
    $location = get_location($id);
    require __DIR__ . '/../views/locations/edit_location.php';
}

function update_location_action($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'country' => trim($_POST['country']),
            'level1'  => trim($_POST['level1']),
            'level2'  => trim($_POST['level2']),
            'level3'  => trim($_POST['level3'])
        ];
        update_location($id, $data);
        header("Location: " . BASE_URL . "/");
        exit;
    }
}

function delete_location_action($id) {
    delete_location($id);
    header("Location: " . BASE_URL . "/");
    exit;
}
