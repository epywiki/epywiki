<?php
// web.php
/**
 * This web.php script uses Bramus router in public/Router.php
 */
require_once __DIR__ . '/app/init.php';

// Load router (in public/Router.php)
require_once __DIR__ . '/public/Router.php';

$router = new \Bramus\Router\Router();

// ================== LOAD CONTROLLERS ================== //
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/DiseaseController.php';
require_once __DIR__ . '/app/controllers/LocationController.php';
require_once __DIR__ . '/app/controllers/ReportController.php';


// ================== ROUTES ================== //

// Install admin
$router->match('GET|POST', '/install_admin', 'install_admin_page');

// Home
$router->get('/home', function () {
    require __DIR__ . '/app/views/home.php';
});
$router->get('/', 'home_page');

// Login
$router->match('GET|POST', '/login', 'login_page');

// Dashboard (editor)
$router->get('/dashboard', 'dashboard_page');

// Admin dashboard
$router->match('GET|POST', '/admin_dashboard', 'admin_dashboard_page');

// Diseases
$router->match('GET|POST', '/add_disease', 'add_disease');
$router->get('/disease_list', 'disease_list_page');
$router->match('GET|POST', '/edit_disease', 'edit_disease_page');
$router->get('/delete_disease', 'delete_disease_page');

// Locations
$router->match('GET|POST', '/locations/add', 'add_location_page');
$router->get('/locations/edit/(\d+)', 'edit_location_page');
$router->post('/locations/update/(\d+)', 'update_location_action');
$router->post('/locations/delete/(\d+)', 'delete_location_action');

// Epi Data
$router->match('GET|POST', '/add_epi_data', 'add_epi_data_page');
$router->get('/edit_epi_data', 'edit_epi_data_page');

// Markdown help
$router->get('/markdown_help', function () {
    require __DIR__ . '/app/views/markdown_help.php';
});

// Forgot password
$router->match('GET|POST', '/forgot_password', 'request_reset_page');

// Reports
$router->get('/reports', 'list_reports_page');
$router->get('/reports/create', 'create_report_page');
$router->post('/reports/store', 'store_report_action');
$router->get('/reports/(\d+)', 'view_report_page');       // ensure function exists
$router->get('/reports/(\d+)/edit', 'edit_report_page');  // ensure function exists
$router->post('/reports/(\d+)/update', 'update_report_action'); // ensure function exists
$router->post('/reports/(\d+)/delete', 'delete_report_action'); // ensure function exists

// ================== 404 Handler ================== //
$router->set404(function () {
    http_response_code(404);
    echo "404 - Page not found";
});
