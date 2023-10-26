<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./src/images/favicon.ico" type="image/x-icon">
  <title>Coffee MS</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Local styles -->
  <link rel="stylesheet" href="./src/styles/main.css">
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