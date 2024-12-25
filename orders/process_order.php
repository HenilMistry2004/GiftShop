<?php
session_start();
include '../connection/connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted data
    $customer_id = $_POST['customer_id'] ?? '';
    $customer_name = $_POST['customerName'] ?? '';
    $order_email = $_POST['order_email'] ?? '';
    $order_phone = $_POST['order_phone'] ?? '';
    $order_address = $_POST['order_address'] ?? '';
    $products = $_POST['products'] ?? [];
    $total_price = $_POST['total_price'] ?? 0.00;

    // Start the transaction
    $conn->begin_transaction();

    try {
        // Loop through each product
        foreach ($products as $product_id => $product_details) {
            $cart_id = $product_details['cart_id']; // Fetch cart_id for each product
            $category_id = $product_details['category_id'];
            $quantity = $product_details['quantity'];

            // Fetch product price from the product table
            $product_query = $conn->prepare("SELECT Product_price FROM product WHERE Product_id = ?");
            $product_query->bind_param("i", $product_id);
            $product_query->execute();
            $product_result = $product_query->get_result();
            $product_data = $product_result->fetch_assoc();
            $product_price = $product_data['Product_price'];

            // Calculate total price for this product (price * quantity)
            $product_total_price = $product_price * $quantity;

            // Insert each product into the orders table
            $stmt = $conn->prepare("INSERT INTO orders 
                (cart_id, customer_id, customerName, order_email, order_phone, order_address, category_id, product_id, quantity, total_price) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("iissssiiii", 
                $cart_id, 
                $customer_id, 
                $customer_name, 
                $order_email, 
                $order_phone, 
                $order_address, 
                $category_id, 
                $product_id, 
                $quantity, 
                $product_total_price
            );
            $stmt->execute();

            // Update the product quantity in the product table
            $updateProductStmt = $conn->prepare("UPDATE product SET quantity = quantity - ? WHERE Product_id = ?");
            $updateProductStmt->bind_param("ii", $quantity, $product_id);
            $updateProductStmt->execute();

            // Check if quantity went below zero
            $result = $conn->query("SELECT quantity FROM product WHERE Product_id = $product_id");
            $row = $result->fetch_assoc();
            if ($row['quantity'] < 0) {
                throw new Exception("Insufficient stock for product ID $product_id.");
            }
        }

        // After inserting the products, update the cart table status to "ordered"
        foreach ($products as $product_details) {
            $cart_id = $product_details['cart_id'];
            $updateCartStmt = $conn->prepare("UPDATE cart SET status = 'ordered' WHERE cart_id = ?");
            $updateCartStmt->bind_param("i", $cart_id);
            $updateCartStmt->execute();
        }

        // Commit the transaction
        $conn->commit();

        // Notify user of success
        echo "<script>alert('Order placed successfully!'); window.location.href='order_history.php';</script>";
    } catch (Exception $e) {
        // Rollback in case of an error
        $conn->rollback();

        // Log the error message for debugging purposes
        error_log("Order placement failed: " . $e->getMessage());

        // Provide a more detailed error message to the user
        echo "<script>alert('Failed to place the order. Reason: " . $e->getMessage() . "'); window.location.href='../cart/cart.php';</script>";
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
