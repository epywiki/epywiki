<?php
//app DashboardController.php
/**
 *  * the set_flash_message() is found in the app/functions.php with the html in flash_message.php with the related css in public/css/style.css
 * 
 */
// ------------------------- EDITOR DASHBOARD -------------------------
function dashboard_page() {
    if (!is_logged_in()) {
         redirect(BASE_URL . '/login');;
    }

    if (!is_approved()) {
    
        set_flash_message("Your account is pending approval.", "info");
        return;
    }

    // Approved editors AND admins can access this
      // Corrected path
    require __DIR__ . '/../views/dashboard/dashboard.php';

}

// ------------------------- ADMIN DASHBOARD -------------------------
function admin_dashboard_page() {
    if (!is_logged_in() || !is_admin()) {
        //echo "Access denied.";
        set_flash_message("Access denied.", "error");
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
    require __DIR__ . '/../views/dashboard/admin_dashboard.php';
}

