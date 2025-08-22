<?php
//public/index.php
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/Router.php'; // Bramus Router
require_once __DIR__ . '/../web.php';

$router->run();
