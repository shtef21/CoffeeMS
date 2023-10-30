<?php

log_out();

function log_out()
{
  session_start();
  setcookie(session_name(), '', 100);
  session_unset();
  session_destroy();
  $_SESSION = array();
}

// Redirect to homepage
redirect_home();
