<?php 
//app/views/forgot_password.php
include __DIR__ . '/../partials/header.php'; 
?>


<div class="grid-container">
    <div class="grid-left">
        <h1>Forgot Password</h1>
        <?php if (!empty($message)): ?>
            <div style="color:green;"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <button type="submit" name="request_reset">Request Password Reset</button>
        </form>
    </div>
</div>



