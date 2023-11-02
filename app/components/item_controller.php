<?php

if (isset($_GET["function_name"])) {

    if ($_GET["function_name"] === 'delete_item' && isset($_GET["id"])) {

        delete_item($_GET["id"]);

    } else if ($_GET["function_name"] === 'add_item' && isset($_GET["category_id"])) {
        add_item($_GET["category_id"], $_GET["item_name"], $_GET["item_price"]);
    }

}

function add_item($category_id, $item_name, $item_price)
{
    echo $category_id;

    $server_name = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'coffeems';

    $mysqli = new mysqli($server_name, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "INSERT INTO items(category_id, item_name, item_price) VALUES(?,?,?);";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {

        $stmt->bind_param("iss", $category_id, $item_name, $item_price);
        $stmt->execute();

    }
    $stmt->close();
    $mysqli->close();

}

function delete_item($item_id)
{
    $server_name = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'coffeems';

    $mysqli = new mysqli($server_name, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "DELETE FROM items where item_id = ?;";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {

        $stmt->bind_param("i", $item_id);
        $stmt->execute();

    }
    $stmt->close();
    $mysqli->close();

    echo "Item with ID $item_id has been deleted.";
}

?>