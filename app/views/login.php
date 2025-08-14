<?php 
// app/views/login.php
include 'header.php'; 
?>

<div class="grid-container">
    <!-- LOGIN FORM -->
    <div class="grid-left">
        <h1>Login</h1>
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
            <div class="form-links">
                <a href="?page=forgot_password">Forgot Password?</a>
            </div>
        </form>
    </div>

    <!-- REQUEST EDITOR FORM -->
    <div class="grid-right">
        <h2>Request Editor Access</h2>
        <p>Fill the form below to request editor permissions. Admin will review and email you a link to create your password.</p>

        <form method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="req_username" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="req_email" required>
            </div>

            <button type="submit" name="request_editor">Request Access</button>
        </form>
    </div>
</div>
