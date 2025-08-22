<?php
// app/views/set_password.php
include __DIR__ . '/../partials/header.php'; 
require_once __DIR__ . '/../init.php'; // for DB functions

// Get user ID from query string
$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    echo "Invalid link.";
    exit;
}

// Fetch the user
$user = get_user_by_id($user_id);
if (!$user || !$user['is_approved']) {
    echo "This account is not active or approved by admin.";
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
    } else {
        // Update the user's password in DB
        update_user_password($user_id, $password);
        $message = "Password set successfully! You can now <a href='?page=login'>login</a>.";
    }
}
?>

<div class="grid-container">
    <div class="grid-left">
        <h1>Set Your Password</h1>
        <?php if ($message): ?>
            <div style="color: red;"><?= $message ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit">Set Password</button>
        </form>
    </div>
</div>

