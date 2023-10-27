<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./src/images/favicon.ico" type="image/x-icon">
  <title>Coffee MS</title>
    
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

if (isset($_POST['username']) && !empty($_POST['password'])) {
  session_start();
  // User input
  $requested_username = $_POST['username'];
  $requested_password = $_POST['password'];
  
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
      
      $_SESSION['username'] = $data[0]['username'];
      $_SESSION['role'] = $data[0]['role'];
      echo "Session variables are set.";
      echo "session " . $_SESSION['username'] . " " . $_SESSION['role'];

      
      // Close the prepared statement and the database connection
      $stmt->close();
      $mysqli->close();
      
      // Return data as JSON
      //echo json_encode($data);
    } else {
      echo "No results found.";
    }
  } else {
    echo "Error: " . $mysqli->error;
  }
}
?>

<body class="login">

  <div class="main-content">
    <div class="form-container">

      <form class="cms-form" action="/coffeems/index.php"  method="post">
        <div class="input-section">
          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Your username...">
        </div>

        <div class="input-section mb30px">
          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Your password...">
        </div>

        <input type="submit" value="Log in">

        <div class="form-footer">
          Don't have an account?
          <a href="/register.html">Register</a>
        </div> 
      </form>
    </div>
  </div>

</body>

</html>