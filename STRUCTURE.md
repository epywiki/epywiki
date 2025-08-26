``` 
epywiki/
├── app/                          # Core application files
│   ├── Parsedown.php             # Markdown parser
│   ├── config.php                # Configuration variables and DB connection
│   ├── controllers/              # Handles HTTP requests and business logic
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── DiseaseController.php
│   │   ├── HomeController.php
│   │   ├── LocationController.php
│   │   └── ReportController.php
│   │
│   ├── functions.php             # Reusable helper functions
│   ├── init.php                  # Runs on every request (session start, DB check, etc.)
│   ├── models/                   # Interacts with the database
│   │   ├── Database.php
│   │   ├── DiseaseModel.php
│   │   ├── LocationModel.php
│   │   ├── ReportModel.php
│   │   └── UserModel.php
│   │
│   └── views/                    # HTML/PHP templates (presentation layer)
│       ├── auth/
│       │   ├── account.php
│       │   ├── forgot_password.php
│       │   ├── login.php
│       │   └── set_password.php
│       │
│       ├── dashboard/
│       │   ├── admin_dashboard.php
│       │   └── dashboard.php
│       │
│       ├── diseases/
│       │   ├── add_disease.php
│       │   ├── disease_list.php
│       │   └── edit_disease.php
│       │
│       ├── home.php
│       │
│       ├── install_admin.php      # For first time installation
│       ├── locations/
│       │   ├── add_location.php
│       │   ├── edit_location.php
│       │   └── location_list.php
│       │
│       ├── markdown_help.php
│       │
│       ├── partials/
│       │   ├── flash_messages.php
│       │   ├── footer.php
│       │   └── header.php
│       │
│       └── reports/
│           ├── create_report.php
│           ├── edit_report.php
│           └── report_list.php
│
├── CONTRIBUTING.md               # Guidelines for contributors
├── LICENSE                       # Open-source license
├── README.md                     # Project documentation
├── epywiki.sqlite                 # SQLite database file
├── install.php                    # Installation script (creates DB, sets first admin)
├── public/                        # Publicly accessible folder (served by the web server)
│   ├── assets/                    # Images, icons, and other static assets
│   ├── css/
│   │   └── styles.css             # Main CSS styles
│   ├── data/                      # JSON data files
│   │   ├── africa.json
│   │   ├── asia.json
│   │   ├── europe.json
│   │   ├── namerica.json
│   │   ├── oceania.json
│   │   └── samerica.json
│   ├── fonts/
│   │   └── LibreBaskerville-italic
│   ├── index.php                  # Front controller (loads app/init.php, handles all requests)
│   └── js/
│
├── structure.md                   # This file (project structure)
└── web.php                        # Routing definitions
