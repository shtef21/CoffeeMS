<?php
      echo $_SESSION["role"];
      session_abort();
      require('login.php');
?>
