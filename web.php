<?php
// web.php
/**
 * This web.php script uses Bramus router in public/Router.php
 */
require_once __DIR__ . '/app/init.php';


// Load router (in public/Router.php)
require_once __DIR__ . '/public/Router.php';

$router = new \Bramus\Router\Router();

//==================ROUTES====================\\

// Install admin
$router->get('/install_admin', function () {
    install_admin_page();
});
$router->post('/install_admin', function () {
    install_admin_page();
});

// Home
$router->get('/', function () {
    home_page();
});

// Login
$router->get('/login', function () {
    login_page();
});
$router->post('/login', function () {
    login_page(); // Or your login form handler
});

// Dashboard (editor)
$router->get('/dashboard', function () {
    dashboard_page();
});


// Admin dashboard (GET & POST)
$router->match('GET|POST', '/admin_dashboard', function () {
    admin_dashboard_page();
});


// Add disease
$router->get('/add_disease', function () {
    add_disease();
});
$router->post('/add_disease', function () {
    add_disease(); // handle form submit
});


// Add location (GET + POST)
$router->match('GET|POST', '/locations/add', function () {
    require_once __DIR__ . '/app/controllers/LocationController.php';
    add_location_page();
});



// Edit epi data
$router->get('/edit_epi_data', function () {
    edit_epi_data_page();
});

// Markdown help
$router->get('/markdown_help', function () {
    require __DIR__ . '/app/views/markdown_help.php';
});

// Disease list
$router->get('/disease_list', function () {
    disease_list_page();
});

// Edit disease
$router->get('/edit_disease', function () {
    edit_disease_page();
});
$router->post('/edit_disease', function () {
    edit_disease_page(); // save changes
});

// Delete disease
$router->get('/delete_disease', function () {
    delete_disease_page();
});

/* Forgot password
$router->get('/forgot_password', function () {
    require __DIR__ . '/app/views/forgot_password.php';
});
*/
$router->get('/forgot_password', function () {
    request_reset_page();
});
$router->post('/forgot_password', function () {
    request_reset_page();
});
$router->get('/add_epi_data', function() {
    require_once __DIR__ . '/app/controllers/EpiDataController.php';
    add_epi_data_page();  // the function we just created
});

$router->post('/add_epi_data', function() {
    require_once __DIR__ . '/app/controllers/EpiDataController.php';
    add_epi_data_page();  // handles the form POST
});

// 404 handler
$router->set404(function() {
    http_response_code(404);
    echo "404 - Page not found";
});
