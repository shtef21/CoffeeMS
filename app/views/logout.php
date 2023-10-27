<?php
      // Clear session
      echo $_SESSION["role"];
      session_abort();

      // Redirect to homepage
      header('Location: ' . $APP_FULL_URL, true, 301);  
      exit();
?>
