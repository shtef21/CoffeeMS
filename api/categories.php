<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('./_db.php');

// Check the HTTP request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $categories = DB\get_categories();
    echo json_encode($categories);
} else {
    // Handle unsupported HTTP methods
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}
?>