<?php

  // Define app endpoints
  $APP_ROOT = './app';
  $API_ROOT = '/CoffeeMS/testing/app/src/data';
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

  include_once($ENDPOINTS["home"])
?>