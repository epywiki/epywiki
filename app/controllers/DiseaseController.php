<?php
//app/controllers/DiseaseController.php

// -------------------------- ADD DISEASE ----------------------
function add_disease() {
    if (!is_logged_in() || !is_approved()) {
        echo "You must be logged in and approved to add diseases.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);

        if ($name) {
            if (add_disease_to_db($name, $description)) {
                echo "<p>Disease added successfully!</p>";
                redirect('index.php?page=home');
            } else {
                echo "<p>Error: Could not add disease (maybe it already exists).</p>";
            }
        } else {
            echo "<p>Name is required.</p>";
        }
    }

    require __DIR__ . '/../views/add_disease.php';
}

// --------------------------- EDIT DISEASE ------------------------
function edit_disease_page() {
    if (!is_logged_in() || !is_approved()) {
        echo "Access denied.";
        return;
    }

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "No disease ID provided.";
        return;
    }

    $disease = get_disease_by_id($id);
    if (!$disease) {
        echo "Disease not found.";
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);

        if ($name) {
            update_disease_in_db($id, $name, $description);
            echo "<p style='color:green;'>Disease updated successfully.</p>";
            redirect('index.php?page=disease_list');
        } else {
            echo "<p style='color:red;'>Name is required.</p>";
        }
    }

    require __DIR__ . '/../views/edit_disease.php';

}

// ----------------------------- DELETE DISEASE ------------------------------
function delete_disease_page() {
    if (!is_logged_in() || !is_admin()) { // maybe restrict to admins
        echo "Access denied.";
        return;
    }

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "No disease ID provided.";
        return;
    }

    delete_disease_from_db($id);
    echo "<p style='color:green;'>Disease deleted successfully.</p>";
    redirect('index.php?page=disease_list');
}

// --------------------------- SHOW DISEASE LIST FOR EDITING OR DELETION -------------------------------
function disease_list_page() {
    if (!is_logged_in() || !is_approved()) {
        echo "Access denied.";
        return;
    }

    $diseases = get_all_diseases();
    require __DIR__ . '/../views/disease_list.php';

}

