# Project Structure: epywiki
```plaintext
epywiki/
├── public/ # Publicly accessible folder (served by the web server)
│ ├── index.php # Front controller (loads app/init.php, handles all requests)
│ ├── css/
│ │ └── styles.css # Main CSS styles
│ ├── js/
│ ├── fonts/
│ │ └── LibreBaskerville-italic
│ ├── data/
│ │ └── kenya.json # JSON data files
│ └── images/ # Images, icons, and other static assets
│
├── app/ # Core application files
│ ├── controllers/ # Handles HTTP requests and business logic
│ │ ├── AuthController.php
│ │ ├── DashboardController.php
│ │ ├── DiseaseController.php
│ │ ├── EpiDataController.php
│ │ ├── HomeController.php
│ │ └── LocationController.php
│ │
│ ├── models/ # Interacts with the database
│ │ ├── Database.php
│ │ ├── DiseaseModel.php
│ │ ├── EpiDataModel.php
│ │ ├── LocationModel.php
│ │ └── UserModel.php
│ │
│ ├── views/ # HTML/PHP templates (presentation layer)
│ │ ├── header.php # Shared header layout
│ │ ├── sidebar.php # Navigation/sidebar layout
│ │ ├── footer.php # Shared footer layout
│ │ ├── home.php # Public homepage
│ │ ├── login.php # User login page
│ │ ├── logout.php # User logout page
│ │ ├── admin_dashboard.php # Admin dashboard (manage editors, site settings)
│ │ ├── dashboard.php # Editor dashboard (manage diseases/stats)
│ │ ├── add_disease.php
│ │ ├── add_location.php
│ │ ├── add_disease_reports.php
│ │ ├── disease_list.php
│ │ ├── edit_disease.php
│ │ ├── edit_epi_data.php
│ │ ├── install_admin.php #For first time installation
│ │ ├── markdown_help.php
│ │ └── view.php # View specific location epidemiology
│ │
│ ├── config.php # Configuration variables and DB connection
│ ├── functions.php # Reusable helper functions
│ ├── Parsedown.php # Markdown parser
│ └── init.php # Runs on every request (session start, DB check, etc.)
│
├── epywiki.sqlite # SQLite database file
├── web.php # Routing definitions
├── install.php # Installation script (creates DB, sets first admin)
├── README.md # Project documentation
├── LICENSE # Open-source license
├── structure.md # This file (project structure)
└── CONTRIBUTING.md # Guidelines for contributors
