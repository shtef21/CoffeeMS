<?php

// Start session
session_start();

// Initialize and setup some variables

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
    "drink_menu" => $API_ROOT . "/drinkMenu.json",
    // Change this when API endpoint is implemented

];

// Include common functions for app
include($APP_ROOT . "/components/functions.php");

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

if (isset($_POST['functionName'])) {

    delete_item($_POST["id"]);

    echo $_POST['functionName'] . " " . $_POST['id'];

    switch ($_POST['functionName']) {
        case 'delete_item':
            delete_item($_POST["id"]);
            break;
    }

}
function delete_item($id)
{
    global $server_name, $username, $password, $dbname;

    $mysqli = new mysqli($server_name, $username, $password, $dbname);

    // Check the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Query to fetch data using a prepared statement
    $sql = "DELETE * FROM items where item_id = ?;";

    echo $sql;
    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {


        $stmt->bind_param("i", $id);
        // Execute the query
        $stmt->execute();

    }
    $stmt->close();
    $mysqli->close();
}
?>