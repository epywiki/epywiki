<?php
//app/controllers/AuthController.php
/**
 * * the set_flash_message() function is found in the app/functions.php with the html in flash_message.php with the related css in public/css/style.css 
 * 
 * 
 */ 
function install_admin_page() {
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
        register_user($username, $email, $password, 1, 1); // Correct order
        $admin = get_user_by_email($email);

       $_SESSION['user_id'] = $admin['id'];
       $_SESSION['username'] = $admin['username'];
       $_SESSION['is_admin'] = 1;
       $_SESSION['is_approved'] = 1;

         redirect(BASE_URL . '/admin_dashboard');
    } else {
        $error = "Invalid email or password too short.";
    }
}
    
    require __DIR__ . '/../views/install_admin.php';
}
// ------------------------- LOGIN -------------------------
function login_page() {
    // Handle POST requests
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // ----------------- HANDLE EDITOR REQUEST -----------------
        if (isset($_POST['request_editor'])) {
            $username = trim($_POST['req_username']);
            $email = trim($_POST['req_email']);

            // Validate username
            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                set_flash_message("Invalid username (letters, numbers, underscores; 3-20 chars).", "error");
                redirect(BASE_URL . '/login');
            }

            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                set_flash_message("Invalid email format.", "error");
                redirect(BASE_URL . '/login');
            }

            // Check if email already exists
            if (get_user_by_email($email)) {
                set_flash_message("An account with this email already exists.", "error");
                redirect(BASE_URL . '/login');
            }

            // Register editor request WITHOUT password
            register_user($username, $email, null, 0, 0); // approved=0, password_hash=NULL

            set_flash_message("Your request has been submitted. Admin will review and email you a link to create your password.", "success");
            redirect(BASE_URL . '/login');
        }

        // ----------------- NORMAL LOGIN -----------------
        if (isset($_POST['email'], $_POST['password'])) {
            $user = get_user_by_email($_POST['email']);

            if ($user && $user['password_hash'] && password_verify($_POST['password'], $user['password_hash'])) {
                if (!$user['is_approved']) {
                    set_flash_message("Your account is pending approval by an admin.", "info");
                    redirect(BASE_URL . '/login');
                }

                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['is_approved'] = $user['is_approved'];

                // Flash welcome message
                set_flash_message("Welcome back, " . $user['username'] . "!", "success");

                // Redirect based on role
                if ($user['is_admin']) {
                    redirect(BASE_URL . '/admin_dashboard');
                } else {
                    redirect(BASE_URL . '/dashboard');
                }
            } else {
                set_flash_message("Invalid email or password.", "error");
                redirect(BASE_URL . '/login');
            }
        }
    }

    // Show login page (GET request)
    require __DIR__ . '/../views/auth/login.php';
}


// ------------------------- ACCOUNT -------------------------
function account_page() {
    if (!is_logged_in()) redirect(BASE_URL . '/dashboard');
 


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_password = $_POST['new_password'];
        if (strlen($new_password) >= 8) {
            update_user_password($_SESSION['user_id'], $new_password);
            
            set_flash_message("Password updated successfully.", "success");
        } else {
            set_flash_message("Password must be atleast 8 characters.", "error");
            
        }
    }
    require __DIR__ . '/../views/auth/account.php';

}

// i dont know where to put this 
function request_reset_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_reset'])) {
        $email = $_POST['email'];
        $editor = find_editor_by_email($email);

        if ($editor) {
            create_password_reset_request($editor['id']);
            set_flash_message("Your request has been submitted.Please wait for admin approval.", "info");
            
        } else {
            set_flash_message("No editor found with this email.", "error");
        }
        require __DIR__ . '/../views/auth/forgot_password.php';
        return;
    }

    // Show reset form if GET
    require __DIR__ . '/../views/auth/forgot_password.php';

}




