<?php
//app/config.php
define('DB_PATH', __DIR__ . '/../epywikidata.sqlite'); // SQLite file location


// Determine the protocol (http or https)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
            || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Get the host (localhost or domain)
$host = $_SERVER['HTTP_HOST'];

// Get the path to the public folder dynamically
$scriptDir = dirname($_SERVER['SCRIPT_NAME']); // e.g., /epywiki/epywiki/public

// Ensure no trailing slash
$scriptDir = rtrim($scriptDir, '/');

// Define BASE_URL dynamically
define('BASE_URL', $protocol . $host . $scriptDir);

