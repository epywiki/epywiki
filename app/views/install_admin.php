<?php
// app/views/install_admin.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Setup Admin - EpyWiki</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1>Initial Setup: Create Admin</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9_]{3,20}" title="Letters, numbers, underscores; 3-20 characters" required>
        
        <label>Email</label>
        <input type="email" name="email" required>
        
        <label>Password (min 6 chars)</label>
        <input type="password" name="password" minlength="6" required>

        <p>To avoid any person from accidentally adding their details in this demo , i have disabled the submit button</p>
       <!--
       <button type="submit">Create Admin</button>
        -->
    </form>
</div>
</body>
</html>

