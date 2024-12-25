<?php
session_start();
include '../connection/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    echo 'Please log in first.';
    exit();
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Validate and sanitize the input
$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($cart_id > 0 && $action === 'removed') {
    // Update the status of the cart item to 'removed'
    $query = "UPDATE cart SET status = 'removed' WHERE cart_id = ? AND customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $cart_id, $user_id);

    if ($stmt->execute()) {
        echo 'Success'; // Response sent back to AJAX if update is successful
    } else {
        echo 'Error updating status: ' . $stmt->error; // Include database error for debugging
    }
} else {
    echo 'Invalid request.';
}
?>
