<?php
//public/index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/Router.php'; // Bramus Router
require_once __DIR__ . '/../web.php';

$router->run();
