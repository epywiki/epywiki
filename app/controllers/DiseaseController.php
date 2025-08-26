<?php
//app/controllers/DiseaseController.php
/**
 *  the set_flash_message() is found in the app/functions.php with the html in flash_message.php with the related css in public/css/style.css
 * 
 */

// -------------------------- ADD DISEASE ----------------------
function add_disease() {
    if (!is_logged_in() || !is_approved()) {
        set_flash_message("You must be logged in and approved to add diseases.", "error");
        redirect(BASE_URL . '/home');
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);

        if ($name) {
            if (add_disease_to_db($name, $description)) {
                set_flash_message("Disease added successfully", "success");
                redirect(BASE_URL . '/home');
            } else {
                set_flash_message("Could not add disease (maybe it already exists)", "error");
            }
        } else {
            set_flash_message("Name is required.", "info");
        }
    }

    require __DIR__ . '/../views/diseases/add_disease.php';
}

// --------------------------- EDIT DISEASE ------------------------
function edit_disease_page() {
    if (!is_logged_in() || !is_approved()) {
        set_flash_message("Access denied.", "error");
        return;
    }

    $id = $_GET['id'] ?? null;
    if (!$id) {
        set_flash_message("No disease ID provided.", "error");
        return;
    }

    $disease = get_disease_by_id($id);
    if (!$disease) {
        set_flash_message("Disease not found.", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);

        if ($name) {
            update_disease_in_db($id, $name, $description);
            set_flash_message("Disease updated successfully.", "success");
             redirect(BASE_URL . '/disease_list');
        } else {
            set_flash_message("Name is required.", "info");
        }
    }

    require __DIR__ . '/../views/diseases/edit_disease.php';

}

// ----------------------------- DELETE DISEASE ------------------------------
function delete_disease_page() {
    if (!is_logged_in() || !is_admin()) { 
        set_flash_message("Only the admin can delete diseases.", "error");
        redirect(BASE_URL . '/home');
        return;
    }

    $id = $_GET['id'] ?? null;
    if (!$id) {
        set_flash_message("No disease ID provided.", "info");
        return;
    }

    delete_disease_from_db($id);
    set_flash_message("Disease deleted successfully.", "success");
    redirect(BASE_URL . '/disease_list');
}

// --------------------------- SHOW DISEASE LIST FOR EDITING OR DELETION -------------------------------
function disease_list_page() {
    if (!is_logged_in() || !is_approved()) {
        set_flash_message("Access denied.", "error");
        return;
    }

    $diseases = get_all_diseases();
    require __DIR__ . '/../views/diseases/disease_list.php';

}

