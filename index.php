<?php

  // Start session
  session_start();

  // Initialize and setup some variables

  if (!isset($_SESSION["role"])) {
    $_SESSION["role"] = 0;
  }
  $page =
    isset($_GET['p']) && $_GET['p'] != ''
    ? $_GET['p']
    : 'home';
  $api_call = isset($_GET['api'])
    ? $_GET['api']
    : '';
  
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
    
    // Assets
    "main.css" => $APP_ROOT . "/src/styles/main.css",
    "topbar-bg.jpg" => $APP_ROOT . "/src/images/topbar-bg.jpg",

    // API
    "drink_menu" => $API_ROOT . "/drinkMenu.json", // Change this when API endpoint is implemented
  ];

  // If this is an API call
  if ($api_call != '') {
    
    // Connect and setup DB
    require($APP_ROOT . '/api.php');

    // Make api call, for example:
    /*
      - get a drink menu
      - create a new drink
      - other CRUD calls
    */
  }
  // Else, return a page
  else {
    include($ENDPOINTS[$page]);
  }
?>