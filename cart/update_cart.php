<?php
session_start();
include '../connection/connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['login'])) {
    echo 'Please log in to update the cart.';
    exit();
}

// Retrieve POST data
$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
$new_quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0; // New quantity value

// Validate the cart ID and new quantity
if ($cart_id <= 0 || $new_quantity <= 0) {
    echo 'Invalid data.';
    exit();
}

// Fetch the product details
$query = "SELECT p.Product_price, p.quantity AS product_stock, c.quantity AS cart_quantity 
          FROM product p 
          INNER JOIN cart c ON p.Product_id = c.product_id 
          WHERE c.cart_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $cart_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($product_price, $product_stock, $cart_quantity);
$stmt->fetch();

if ($stmt->num_rows == 0) {
    echo 'Product not found in the cart.';
    exit();
}

// Check if the new quantity exceeds stock
if ($new_quantity > $product_stock) {
    echo 'Not enough stock available.';
    exit();
}

// Update the cart with the new quantity
$update_query = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
$update_stmt = $conn->prepare($update_query);
$update_stmt->bind_param('ii', $new_quantity, $cart_id);
$update_stmt->execute();

// Calculate the new total price for the cart
$total_price = 0;
$query_total = "SELECT cart.quantity, product.Product_price 
                FROM cart 
                INNER JOIN product ON cart.product_id = product.Product_id 
                WHERE cart.customer_id = ? AND cart.status = 'not ordered'";
$total_stmt = $conn->prepare($query_total);
$total_stmt->bind_param('i', $_SESSION['user_id']);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
while ($row = $total_result->fetch_assoc()) {
    $total_price += $row['quantity'] * $row['Product_price'];
}

// Return the updated stock and total price
echo json_encode(['stock' => $product_stock, 'total_price' => $total_price]);

$stmt->close();
$update_stmt->close();
$conn->close();
?>
