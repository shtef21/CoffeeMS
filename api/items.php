<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./_db.php');
require_once('./_auth.php');

// Check the HTTP request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $items = DB\get_items();
    echo json_encode($items);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate user
    $token = AUTH\get_token_from_header();
    $authorized = AUTH\validate_token($token);

    // User unauthorized
    if (!$authorized) {
        http_response_code(401); // Unauthorized
        echo json_encode(['error' => 'Unauthorized']);
        exit();
    }
    // User authorized - proceed
    else {
        // Parse the JSON request body
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Validate and sanitize input data
        $category_id = filter_var($data['category_id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)));
        $item_name = trim($data['item_name']);
        $item_price = filter_var($data['item_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
        $new_id = DB\add_item($category_id, $item_name, $item_price);
        if (is_null($new_id)) {
            echo json_encode(['success' => false]);
        } else {
            echo json_encode(['success' => true, 'item_id' => $new_id]);
        }
        exit();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    // Validate user
    $token = AUTH\get_token_from_header();
    $authorized = AUTH\validate_token($token);

    // User unauthorized
    if (!$authorized) {
        http_response_code(401); // Unauthorized
        echo json_encode(['error' => 'Unauthorized']);
        exit();
    }
    // User authorized - proceed
    else {
        // Parse the JSON request body
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Validate and sanitize input data
        $item_id = filter_var($data['item_id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)));
        #$category_id = filter_var($data['category_id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)));
        $item_name = trim($data['item_name']);
        $item_price = filter_var($data['item_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
        // Check if the provided item ID is valid
        if ($item_id !== null && $item_name !== null && $item_price !== null) {
            $success = DB\update_item($item_id, $item_name, $item_price);
            if ($success) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Item update failed. Have you sent item_id, category_id, item_name and item_price?']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid input data']);
        }
        exit();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    // Validate user
    $token = AUTH\get_token_from_header();
    $authorized = AUTH\validate_token($token);

    // User unauthorized
    if (!$authorized) {
        http_response_code(401); // Unauthorized
        echo json_encode(['error' => 'Unauthorized', 'you_sent' => $token]);
        exit();
    }
    // User authorized - proceed
    else {
        // Get the 'id' from query parameters
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    
        if ($id !== null) {
            $successful_delete = DB\delete_item($id);
            if ($successful_delete) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            // Handle invalid or missing 'id'
            echo json_encode(['error' => 'Invalid or missing item id']);
        }
        exit();
    }
    
} else {
    // Handle unsupported HTTP methods
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}
?>