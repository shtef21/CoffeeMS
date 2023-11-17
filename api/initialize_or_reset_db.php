<?php
require('_db.php');

// Reset DB
DB\initialize_database();

// Wait for database to initialize
usleep(250000);

// Redirect to homepage
header("Location: /CoffeeMS");
exit;
