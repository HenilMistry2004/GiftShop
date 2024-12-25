<?php
session_start();
include '../connection/connection.php';
if (!isset($_SESSION['login'])) {
    header('Location: ../login/login.php'); // Redirect to login page if not logged in
    exit();
}
// Assuming user is logged in and user_id is stored in the session
$user_id = $_SESSION['user_id'];

$category_id = $_POST['category_id']; // Get category ID from the form
$product_id = $_POST['sub_service_id'];
$product_name = $_POST['sub_service_name'];
$product_price = $_POST['sub_service_price'];

// Check if the product is already in the cart with a "not ordered" status
$query = "SELECT * FROM cart WHERE customer_id = ? AND product_id = ? AND status = 'not ordered'";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update quantity if the product exists and status is 'not ordered'
    $query = "UPDATE cart SET quantity = quantity + 1 WHERE customer_id = ? AND product_id = ? AND status = 'not ordered'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $user_id, $product_id);
} else {
    // Insert new product into the cart with status 'not ordered'
    // Corrected number of parameters and types for bind_param
    $query = "INSERT INTO cart (customer_id, product_id, product_name, product_price, quantity, status, category_id) 
              VALUES (?, ?, ?, ?, 1, 'not ordered', ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iisdi', $user_id, $product_id, $product_name, $product_price, $category_id);
}

$stmt->execute();

header("Location: cart.php");
exit();
?>
