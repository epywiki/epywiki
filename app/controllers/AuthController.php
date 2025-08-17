<?php
/**
 *app/controllers/AuthController.php
 *
 * This controller handles all authentication-related functionality in the epywiki project.
 * 
 * Main responsibilities:
 * 1. Installing the first admin account (install_admin_page)
 *    - Sets up the initial admin user during first-time setup.
 *    - Stores user info in the database and initializes session variables.
 *
 * 2. User login (login_page)
 *    - Handles normal user login.
 *    - Processes editor requests: users can submit a request to become an editor,
 *      which must be approved by the admin.
 *    - Maintains session information for logged-in users.
 *
 * 3. Account management (account_page)
 *    - Allows logged-in users to update their passwords.
 *
 * Notes:
 * - This file is part of a custom, vanilla PHP MVC structure.
 * - Session management is handled here in conjunction with `init.php`.
 * - Passwords are hashed using PHP's `password_hash()` for security.
 * - Editor approval and account setup flow is designed to be manual: the admin approves requests
 *   and provides users with a link to set their password.
 *
 * Usage:
 * Include this controller in your routing (`web.php`) and call the appropriate function based on the request:
 *   - install_admin_page()
 *   - login_page()
 *   - account_page()
 *
 * Author: [Your Name or "Epywiki Team"]
 * Date: [YYYY-MM-DD]
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


        redirect('index.php?page=admin_dashboard');
    } else {
        $error = "Invalid email or password too short.";
    }
}
    
    require __DIR__ . '/../views/install_admin.php';
}

// ------------------------- LOGIN -------------------------
function login_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // ----------------- HANDLE EDITOR REQUEST -----------------
        if (isset($_POST['request_editor'])) {
            $username = trim($_POST['req_username']);
            $email = trim($_POST['req_email']);

            // Validate username
            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
                echo "Invalid username (letters, numbers, underscores; 3-20 chars).";
                return;
            }

            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format.";
                return;
            }

            // Check if email already exists
            if (get_user_by_email($email)) {
                echo "An account with this email already exists.";
                return;
            }

            // Register editor request WITHOUT password
            register_user($username, $email, null, 0, 0); // approved=0, password_hash=NULL

            echo "Your request has been submitted. Admin will review and email you a link to create your password.";
            require __DIR__ . '/../views/home.php';
            return;
        }

        // ----------------- NORMAL LOGIN -----------------
        if (isset($_POST['email'], $_POST['password'])) {
            $user = get_user_by_email($_POST['email']);

            if ($user && $user['password_hash'] && password_verify($_POST['password'], $user['password_hash'])) {
                if (!$user['is_approved']) {
                    echo "Your account is pending approval by an admin.";
                    return;
                }

                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['is_approved'] = $user['is_approved'];

                // Redirect based on role
                if ($user['is_admin']) {
                    redirect('index.php?page=admin_dashboard');
                } else {
                    redirect('index.php?page=dashboard');
                }
            } else {
                echo "Invalid email or password.";
            }
        }
    }

    // Show login page
    require __DIR__ . '/../views/login.php';
}

// ------------------------- ACCOUNT -------------------------
function account_page() {
    if (!is_logged_in()) redirect('index.php?page=login');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_password = $_POST['new_password'];
        if (strlen($new_password) >= 6) {
            update_user_password($_SESSION['user_id'], $new_password);
            echo "Password updated successfully.";
        } else {
            echo "Password must be at least 6 characters.";
        }
    }
    require __DIR__ . '/../views/account.php';
}

// i dont know where to put this 
if(isset($_POST['request_reset'])){
    $email = $_POST['email'];
    // Check if editor exists
    $editor = find_editor_by_email($email); // create this function in your model
    if($editor){
        // Save a reset request in DB, with status 'pending'
        create_password_reset_request($editor['id']); // implement in model
        $message = "Your request has been submitted. Please wait for admin approval.";
    } else {
        $message = "No editor found with this email.";
    }
}




