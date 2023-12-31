<?php
namespace DB;

// Define the database connection as a global variable
$mysqli = null;

function get_connection()
{
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

function initialize_database()
{
    $mysqli = get_connection();

    // Drop the database if it exists
    $drop_db_query = "DROP DATABASE IF EXISTS `coffeems`;";
    $mysqli->query($drop_db_query);

    // Execute the coffeems.sql script to recreate the database and its structure
    $coffeems_sql = file_get_contents("../coffeems.sql");
    $mysqli->multi_query($coffeems_sql);

    // Close the connection
    $mysqli->close();
}

function get_items()
{
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

function add_item($category_id, $item_name, $item_price)
{
    $mysqli = get_connection();

    // SQL statement to insert an item
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

function delete_item($item_id)
{
    $mysqli = get_connection();

    // SQL statement to delete an item by its ID
    $sql = "DELETE FROM items WHERE item_id = ?";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $item_id); // Assuming item_id is an integer
        $stmt->execute();

        // Check if the deletion was successful
        if ($stmt->affected_rows > 0) {
            // Return true if the item was deleted
            return true;
        } else {
            // Return false if the item was not found or not deleted
            return false;
        }

        $stmt->close();
    }
    // Return false if there was an issue with the query or execution
    return false;
}

function update_item($item_id, $item_name, $item_price)
{
    // Parameters cannot be null
    if ($item_id === null || $item_name === null || $item_price === null) {
        return false;
    }

    $mysqli = get_connection();

    // SQL statement to update an item by its ID
    $sql = "UPDATE items SET item_name = ?, item_price = ? WHERE item_id = ?";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssi", $item_name, $item_price, $item_id);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            // Return true if the item was updated
            return true;
        } else {
            // Return false if the item was not found or not updated
            return false;
        }

        $stmt->close();
    }
    // Return false if there was an issue with the query or execution
    return false;
}


function get_categories()
{
    $mysqli = get_connection();
    $queryString = "SELECT * FROM categories;";
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

function get_site_info()
{
    $mysqli = get_connection();
    $query = "SELECT * FROM `site_info`";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row; // Return the site info data
    } else {
        return null; // Return null if no data found
    }
}

// Get a user by its UUID; used for authorization
function get_user_by_uuid($uuid)
{
    $msqli = get_connection();
    $sql = "SELECT * FROM users where token = ?";

    // Get user
    $stmt = $msqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $uuid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        }
    }

    // Not found or error
    return null;
}
