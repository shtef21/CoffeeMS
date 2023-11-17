<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./_db.php');

// Check the HTTP request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $site_info = DB\get_site_info();
    echo json_encode($site_info);
} else {
    // Return a 404 Not Found response for unsupported HTTP methods
    http_response_code(404);
    echo json_encode(['error' => 'Resource not found']);
}
?>
