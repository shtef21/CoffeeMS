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
<?php

// Database configuration
$server_name = 'localhost';
$username = 'root';
$password = '';
$dbname = 'coffeems';
$error_message = null;
$successful_login = false;

if (isset($_POST['username']) && !empty($_POST['password']) && isset($_POST['email'])) {

    // Create a database connection
    $mysqli = new mysqli($server_name, $username, '', $dbname);

    // User input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Use PASSWORD_BCRYPT for password hashing

    // Check the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Query to check if the username already exists
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($mysqli);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error_message = 'Username already exists!';
        } else {
            // Query to insert a new user
            $sql = "INSERT INTO users(email, username, password, role) VALUES(?, ?, ?, 1);";

            // Prepare the statement
            $stmt2 = $mysqli->prepare($sql);

            if ($stmt2) {
                // Bind parameters and execute the statement
                $stmt2->bind_param("sss", $email, $username, $hashed_password);

                // Execute the query
                $stmt2->execute();

                // Trigger auto-login form
                $successful_login = true;
            } else {
                echo "Error: " . $mysqli->error;
            }

            // Close the prepared statement
            $stmt2->close();
        }
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $mysqli->close();
}
?>

<body class="register">

    <div class="main-content">
        <div class="form-container">

            <form class="cms-form" action="?p=register" method="POST">
                <div class="input-section">
                    <label for="name">Email</label>
                    <input type="text" name="email" placeholder="Your email.." <?php
                    if (isset($_POST['email'])) {
                        echo 'value="' . $_POST['email'] . '"';
                    }
                    ?> />
                </div>

                <div class="input-section">
                    <label for="name">Username</label>
                    <input type="text" name="username" placeholder="Your name.." <?php
                    if (isset($_POST['username'])) {
                        echo 'value="' . $_POST['username'] . '"';
                    }
                    ?> />
                </div>

                <div class="input-section mb30px">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Write a strong password...">
                </div>

                <?php
                if ($error_message != null) {
                    echo ''
                        . '<div style="margin-bottom: 10px; color: red;">'
                        . $error_message
                        . '</div>';
                }
                ?>

                <input type="submit" value="Create an account">

                <div class="form-footer">
                    Already have an account?
                    <a href="?p=login">Login</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Auto-login form -->
    <form id="redirect-form" method="post" action="?p=login">
        <!-- Include hidden input fields for POST variables -->
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <input type="hidden" name="password" value="<?php echo $password; ?>">
    </form>

    <script>
        <?php
        if ($successful_login) {
            echo "document.getElementById('redirect-form').submit()";
        }
        ?>
    </script>
</body>

</html>