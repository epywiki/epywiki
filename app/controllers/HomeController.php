<?php
// app/controllers/HomeController.php

require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../Parsedown.php';
require_once __DIR__ . '/../models/LocationModel.php';
require_once __DIR__ . '/../models/DiseaseModel.php'; 
require_once __DIR__ . '/../models/ReportModel.php'; 

$Parsedown = new Parsedown();

function home_page() {
    // fetch data from DB
    $locations = get_all_locations();
    $diseases  = get_all_diseases();
    $reports = get_all_reports(); // Or your query logic


    // load the view with variables
    require __DIR__ . '/../views/home.php';
}



