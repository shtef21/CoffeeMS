<?php

// Start session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION["role"])) {
    $_SESSION["role"] = 0;
}
if (!isset($_SESSION["username"])) {
    $_SESSION["username"] = null;
}
$_SESSION["logged_in"] = $_SESSION["username"] != null;

$page =
    isset($_GET['p']) && $_GET['p'] != ''
    ? $_GET['p']
    : 'home';

$APP_FULL_URL = 'http://localhost/CoffeeMS/';
$APP_ROOT = './app';
$API_ROOT = '/CoffeeMS/app/src/data';

// Define app endpoints
$ENDPOINTS = [
    // Pages
    "home" => $APP_ROOT . "/views/home.php",
    "login" => $APP_ROOT . "/views/login.php",
    "logout" => $APP_ROOT . "/views/logout.php",
    "register" => $APP_ROOT . "/views/register.php",
    "about_us" => $APP_ROOT . "/views/aboutUs.php",
    "admin" => $APP_ROOT . "/views/admin.php",
    "search_drink" => $APP_ROOT . "/views/searchDrink.php",
    "testApi" => $APP_ROOT . "/views/testApi.php",

    // Assets
    "main.css" => $APP_ROOT . "/src/styles/main.css",
    "topbar-bg.jpg" => $APP_ROOT . "/src/images/topbar-bg.jpg",

    // API
    "drink_menu" => $API_ROOT . "/drinkMenu.json",
    // Change this when API endpoint is implemented

];

// Include common functions for app
include($APP_ROOT . "/components/functions.php");

// Return page
include($ENDPOINTS[$page]);
