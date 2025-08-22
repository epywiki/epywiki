<?php
// app/init.php
session_start();

// Load core helpers and config
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/config.php';

// Load models
require_once __DIR__ . '/models/Database.php';
require_once __DIR__ . '/models/DiseaseModel.php';
require_once __DIR__ . '/models/LocationModel.php';
require_once __DIR__ . '/models/UserModel.php';


// Load controllers
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/DiseaseController.php';
require_once __DIR__ . '/controllers/LocationController.php';
require_once __DIR__ . '/controllers/HomeController.php';

// Load Parsedown (Markdown to HTML converter)
// Thanks to the creator of Parsedown: https://github.com/erusev/parsedown
require_once __DIR__ . '/Parsedown.php';
$Parsedown = new Parsedown();

// Create DB if it doesn't exist
if (!file_exists(DB_PATH)) {
    require __DIR__ . '/../install.php';
}

// Create tables if they don't exist yet
create_tables();

// If no users exist, redirect to install admin page
if (count_users() === 0 && strpos($_SERVER['REQUEST_URI'], '/install_admin') === false) {
    header("Location: /epywiki/epywiki/public/install_admin");
    exit;
}

