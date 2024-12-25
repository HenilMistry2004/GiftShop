<?php
// Include database connection
include 'connection/connection.php';
session_start();

// Ensure delivery personnel is logged in
if (!isset($_SESSION['delivery_login']) || !isset($_SESSION['delivery_id'])) {
    echo "Unauthorized access.";
    exit();
}

$delivery_id = $_SESSION['delivery_id'];  // Delivery personnel ID

// Get the scanned Order ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Update the order status and assign the delivery personnel ID
    $query = "
        UPDATE orders 
        SET status = 'order_completed', DeliveryPersonnelID = ? 
        WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $delivery_id, $order_id);

    if ($stmt->execute()) {
        echo "Order ID $order_id marked as completed.";
    } else {
        echo "Failed to update order. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>

