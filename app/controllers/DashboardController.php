<?php
//app DashboardController.php
// ------------------------- EDITOR DASHBOARD -------------------------
function dashboard_page() {
    if (!is_logged_in()) {
        redirect('index.php?page=login');
    }

    if (!is_approved()) {
        echo "Your account is pending approval.";
        return;
    }

    // Approved editors AND admins can access this
    require __DIR__ . '/../views/dashboard.php';

}

// ------------------------- ADMIN DASHBOARD -------------------------
function admin_dashboard_page() {
    if (!is_logged_in() || !is_admin()) {
        echo "Access denied.";
        return;
    }

    // Handle admin actions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['approve'])) {
            update_user_status($_POST['user_id'], 1);
        }
        if (isset($_POST['remove'])) {
            delete_user($_POST['user_id']);
        }
        if (isset($_POST['add_user'])) {
            register_user($_POST['new_email'], $_POST['new_password'], 0, 1); // editor, approved
        }
    }

    $users = get_all_users();
    require __DIR__ . '/../views/admin_dashboard.php';
}

