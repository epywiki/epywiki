<?php
//web.php
require_once __DIR__ . '/app/init.php';
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/DashboardController.php';
require_once __DIR__ . '/app/controllers/DiseaseController.php';
require_once __DIR__ . '/app/controllers/LocationController.php';
require_once __DIR__ . '/app/controllers/EpiDataController.php';
require_once __DIR__ . '/app/controllers/HomeController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'install_admin':
         install_admin_page();
         break;

    case 'home':
        home_page(); // function in controller.php
        break;

    case 'login':
        login_page(); // function in controller.php
        break;

    case 'dashboard':
        dashboard_page(); // function in controller.php
        break;

    case 'admin_dashboard':
        admin_dashboard_page(); // Make sure this function exists in controller.php
        break;
    
    case 'add_disease':
          add_disease();
          break;

    case 'add_location':
          add_location();
          break;
             
    case 'edit_epi_data':
          edit_epi_data_page();
          break;
    
    case 'markdown_help':
          require __DIR__ . '/app/views/markdown_help.php';
          break;

    case 'disease_list':
          disease_list_page();
          break;

    case 'edit_disease':
          edit_disease_page();
          break;

    case 'delete_disease':
          delete_disease_page();
          break;
      
    case 'forgot_password':
          require __DIR__ . '/app/views/forgot_password.php';
          break;
      
    default:
        http_response_code(404);
        echo "404 - Page not found";
        break;
}
