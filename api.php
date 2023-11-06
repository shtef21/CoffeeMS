<?php
// Include any necessary database connection or configuration here

// Check the HTTP request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve items from the database (e.g., SELECT query)
    // Implement your database logic here
    // Send JSON response
    echo json_encode(['message' => 'lets say that this response are the items']);

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Parse the JSON request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate and sanitize input data
    $category_id = filter_var($data['category_id'], FILTER_SANITIZE_STRING);
    $item_name = filter_var($data['item_name'], FILTER_SANITIZE_STRING);
    $item_price = filter_var($data['item_price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Insert a new item into the database (e.g., INSERT query)
    // Implement your database logic here
    // Send JSON response
    echo json_encode(['message' => 'Add item']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the 'id' from query parameters
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id !== null) {
        // Delete the item from the database based on 'id' (e.g., DELETE query)
        // Implement your database logic here
        // Send JSON response
        echo json_encode(['message' => 'Delete item']);
    } else {
        // Handle invalid or missing 'id'
        echo json_encode(['error' => 'Invalid or missing item id']);
    }
} else {
    // Handle unsupported HTTP methods
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}
?>
