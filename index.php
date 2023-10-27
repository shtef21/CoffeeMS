<?php

  session_start();

  $page =
    isset($_GET['p']) && $_GET['p'] != ''
    ? $_GET['p']
    : 'home';
  $api_call = isset($_GET['api'])
    ? $_GET['api']
    : '';

  // Define app endpoints
  $APP_ROOT = './app';
  $API_ROOT = '/CoffeeMS/app/src/data';
  $ENDPOINTS = [
    // Pages
    "home" => $APP_ROOT . "/home.php",
    "login" => $APP_ROOT . "/login.php",
    "log_out" => $APP_ROOT . "/logout.php",
    "register" => $APP_ROOT . "/register.php",
    "about_us" => $APP_ROOT . "/aboutUs.php",
    "admin" => $APP_ROOT . "/admin.php",
    "search_drink" => $APP_ROOT . "/searchDrink.php",
    
    // Assets
    "main.css" => $APP_ROOT . "/src/styles/main.css",
    "topbar-bg.jpg" => $APP_ROOT . "/src/images/topbar-bg.jpg",

    // API
    "drink_menu" => $API_ROOT . "/drinkMenu.json", // Change this when API endpoint is implemented
  ];

  // Safe-checking
  if (!isset($_SESSION["role"])) {
    $_SESSION["role"] = 0;
  }

  echo '<h1>Session role: ' . $_SESSION["role"] . '</h1>';

  if ($api_call != '') {
    
    // Spoji se na bazu
    require($APP_ROOT . '/api.php');

    // Pozovi funkciju iz api.php koja će dohvaćati tablicu koju traži $api_call
    /*
      - dohvati tablicu menija
      - stvori novi item u meniju
      - CRUD ostalih tablica
      - itd.
    */
  }
  else {
    include($ENDPOINTS[$page]);
  }
?>