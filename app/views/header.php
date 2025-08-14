<?php
// app/views/header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EpyWiki</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header class="site-header">
    <div class="header-left">
        <h1 class="logo">EpyWiki</h1>
    </div>

    <nav class="header-nav">
        <a href="?page=home">Home</a>
        <a href="?page=login">Login</a>
    </nav>

    <div class="header-right" id="editor_message">
        <?php
        if (isset($_SESSION['username'])) {
            $hour = date('H');
            if ($hour < 12) {
                $greeting = "Good morning";
            } elseif ($hour < 18) {
                $greeting = "Good afternoon";
            } else {
                $greeting = "Good evening";
            }
            echo "<p>{$greeting}, <strong>" . htmlspecialchars($_SESSION['username']) . "</strong>!</p>";
        }
        ?>
    </div>
</header>
<main class="container">
