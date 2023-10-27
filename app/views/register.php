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

      <form class="cms-form" action="/index.html">
        <div class="input-section">
          <label for="name">Full name</label>
          <input type="text" id="name" name="name" placeholder="Your name..">
        </div>

        <div class="input-section mb30px">
          <label for="password">Password</label>
          <input type="text" id="password" name="password" placeholder="Write a strong password...">
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