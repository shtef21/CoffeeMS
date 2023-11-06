<?php namespace DB;

// Define the database connection as a global variable
$mysqli = null;

function get_connection() {
    global $mysqli; // Access the global connection variable

    if ($mysqli === null) {
        $server_name = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'coffeems';

        $mysqli = new \mysqli($server_name, $username, $password, $dbname);
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
    }

    return $mysqli;
}

function get_items() {
    $mysqli = get_connection();
    $queryString = "SELECT * FROM items;";
    $items = array();

    $stmt = $mysqli->prepare($queryString);
    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
    }

    $stmt->close();
    return $items;
}

function add_item($category_id, $item_name, $item_price) {
    $mysqli = get_connection();

    $sql = "INSERT INTO items(category_id, item_name, item_price) VALUES(?,?,?);";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iss", $category_id, $item_name, $item_price);
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->affected_rows > 0) {
            // Return the newly inserted item's ID
            return $stmt->insert_id;
        } else {
            // Return null if the item was not created
            return null;
        }

        $stmt->close();
    }
    return null; // Return null if there was an issue with the query or execution
}
