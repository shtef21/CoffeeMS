<?php

// Redirect to homepage
function redirect_home()
{
    header('Location: http://localhost/CoffeeMS/', true, 301);
    exit();
}