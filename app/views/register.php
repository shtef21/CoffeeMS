<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./src/images/favicon.ico" type="image/x-icon">
    <title>Coffee MS - Register</title>

    <?php
    require($APP_ROOT . '/components/imports.php')
        ?>
</head>

<body class="register">

    <div class="main-content">
        <div class="form-container">

            <form class="cms-form" action="?p=register" method="POST">
                <div class="input-section">
                    <label for="name">Email</label>
                    <input type="text" name="email" placeholder="Your email..">
                </div>

                <div class="input-section">
                    <label for="name">Username</label>
                    <input type="text" name="username" placeholder="Your name..">
                </div>

                <div class="input-section mb30px">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Write a strong password...">
                </div>

                <input type="submit" value="Create an account">

                <div class="form-footer">
                    Already have an account?
                    <a href="/login.html">Login</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php

// Database configuration
$server_name = 'localhost';
$username = 'root';
$password = '';
$dbname = 'coffeems';

if (isset($_POST['username']) && !empty($_POST['password']) && isset($_POST['email'])) {

    // Create a database connection
    $mysqli = new mysqli($server_name, $username, '', $dbname);

    // User input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashed_password = password_hash($password, CRYPT_BLOWFISH);

    // Check the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($mysqli);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo 'Korisničko ime već postoji!';
    } else {
        // Query to fetch data using a prepared statement
        $sql = "INSERT INTO users(email, username, password) VALUES(?, ?, ?);";

        // Prepare the statement
        $stmt2 = $mysqli->prepare($sql);

        if ($stmt2) {
            // Bind parameters and execute the statement
            $stmt2->bind_param("sss", $email, $username, $hashed_password);

            // Execute the query
            $stmt2->execute();

            // Get the result
            $result = $stmt2->get_result();

        } else {
            echo "Error: " . $mysqli->error;
        }

    }


    // Close the prepared statement and the database connection
    $stmt->close();
    $mysqli->close();



}
?>