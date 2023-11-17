<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./src/images/favicon.ico" type="image/x-icon">
    <title>Coffee MS - Login</title>

    <?php
    require($APP_ROOT . '/components/imports.php')
    ?>
</head>

<?php

// Database configuration
$server_name = 'localhost';
$username = 'root';
$password = '';
$dbname = 'coffeems';
$error_message = null;

if (isset($_POST['username']) && !empty($_POST['password'])) {

    session_abort();
    session_start();

    // User input
    $requested_username = $_POST['username'];
    $requested_password = $_POST['password'];

    // Create a database connection
    $mysqli = new mysqli($server_name, $username, $password, $dbname);

    // Query to fetch data using a prepared statement
    $sql = "SELECT * FROM users WHERE username = ?";

    // Prepare the statement
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("s", $requested_username);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // If query executed
        if ($result) {
            $data = array();

            // Iterate rows
            while ($row = $result->fetch_assoc()) {
                // Add row to data
                $data[] = $row;
            }

            // If array is not empty, check the password
            if (!empty($data)) {
                // Verify the hashed password
                $stored_password = $data[0]['password'];

                if (password_verify($requested_password, $stored_password)) {
                    // Password is correct; set session data
                    $_SESSION['username'] = $data[0]['username'];
                    $_SESSION['role'] = $data[0]['role'];
                    $_SESSION['token'] = $data[0]['token'];
                    echo "Session variables are set.";
                    echo "session " . $_SESSION['username'] . " " . $_SESSION['role'];

                    // Redirect to home
                    redirect_home();
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "No results found.";
            }

            // Close the prepared statement and the database connection
            $stmt->close();
            $mysqli->close();
        } else {
            echo "Error: " . $mysqli->error;
        }
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>

<body class="login">

    <div class="main-content">
        <div class="form-container">

            <form class="cms-form" action="?p=login" method="post">
                <div class="input-section">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Your username..." autofocus>
                </div>

                <div class="input-section mb30px">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Your password...">
                </div>

                <?php
                if ($error_message != null) {
                    echo ''
                        . '<div style="margin-bottom: 10px; color: red;">'
                        . $error_message
                        . '</div>';
                }
                ?>

                <input type="submit" value="Log in">

                <div class="form-footer">
                    Don't have an account?
                    <a href="?p=register">Register</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>