<?php
namespace AUTH;

require_once('./_db.php'); // Include the database file

// Get Bearer token from 'Authorization' header
function get_token_from_header()
{
    // Get the authorization header
    $headers = apache_request_headers();
    $authHeader = $headers['Authorization'] ?? '';

    // Check if the Authorization header contains 'Bearer ' followed by a token
    if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
        $token = $matches[1]; // Extract the token
        return $token;
    }
    
    // No token found
    return null;
}

// Validate that user is admin
function validate_token($uuid)
{
    if (!empty($uuid)) {
        $user = \DB\get_user_by_uuid($uuid);
        return $user['role'] == 2;
    }
    return false;
}
?>
