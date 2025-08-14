<?php
//app/functions.php

function is_logged_in() {
    return isset($_SESSION['user_id']);
}
/*
function is_approved() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']['is_approved']) && $_SESSION['user']['is_approved'] == 1;
}
*/
function is_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

function redirect($url) {
    header("Location: $url");
    exit;
}
