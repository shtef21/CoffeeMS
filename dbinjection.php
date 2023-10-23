<?php

// Database configuration
$server_name = 'localhost';
$username = 'root';
$password = '';
$dbname = 'coffeems';

// User input
$requested_username = 'admin_user';
$requested_password = 'admin_password';

// Create a database connection
$mysqli = new mysqli($server_name, $username, $password, $dbname);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query to fetch data using a prepared statement
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

if ($stmt) {
    // Bind parameters and execute the statement
    $stmt->bind_param("ss", $requested_username, $requested_password);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result) {
        $data = array();

        // Fetch data and store it in an array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $mysqli->close();

        // Return data as JSON
        echo json_encode($data);
    } else {
        echo "No results found.";
    }
} else {
    echo "Error: " . $mysqli->error;
}
?>