<?php
session_start();
include '../connection/connection.php';

// Check if POST data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging: Check the POST data
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    
    $customer_id = $_POST['customer_id'] ?? '';
    $customer_name = $_POST['customerName'] ?? '';
    $order_email = $_POST['order_email'] ?? '';
    $order_phone = $_POST['order_phone'] ?? '';
    $order_address = $_POST['order_address'] ?? '';
    $products = $_POST['products'] ?? [];
    $total_price = $_POST['total_price'] ?? 0.00; // Ensure this is received
} else {
    // Redirect if no POST data is present
    header('Location: ../cart/cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        /* Styling here */
    </style>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    table th,
    table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f4f4f4;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        text-align: center;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<body>
    <div class="container">
        <h1>Order Confirmation</h1>

        <form action="process_order.php" method="POST">
            <h2>Customer Details</h2>
            <div class="form-group">
                <label for="customerName">Name</label>
                <input type="text" id="customerName" name="customerName" value="<?php echo htmlspecialchars($customer_name); ?>" required>
            </div>

            <div class="form-group">
                <label for="order_email">Email</label>
                <input type="email" id="order_email" name="order_email" value="<?php echo htmlspecialchars($order_email); ?>" required>
            </div>

            <div class="form-group">
                <label for="order_phone">Phone</label>
                <input type="tel" id="order_phone" name="order_phone" value="<?php echo htmlspecialchars($order_phone); ?>" required>
            </div>

            <div class="form-group">
                <label for="order_address">Address</label>
                <textarea id="order_address" name="order_address" rows="4" required><?php echo htmlspecialchars($order_address); ?></textarea>
            </div>

            <h2>Order Summary</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cart ID</th>
                        <th>Product ID</th>
                        <th>Category ID</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Loop through products and calculate price
                    foreach ($products as $product): 
                        // Fetch product details from the database
                        $product_id = $product['product_id'];
                        $product_query = "SELECT Product_price FROM product WHERE Product_id = ?";
                        $product_stmt = $conn->prepare($product_query);
                        $product_stmt->bind_param("i", $product_id);
                        $product_stmt->execute();
                        $product_result = $product_stmt->get_result();
                        $product_data = $product_result->fetch_assoc();
                        $product_price = $product_data['Product_price'];
                        $total_product_price = $product_price * $product['quantity'];
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['cart_id']); ?></td>
                            <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($product['category_id']); ?></td>
                            <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                            <td>Rs <?php echo number_format($product_price, 2); ?></td>
                            <td>Rs <?php echo number_format($total_product_price, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <h2>Total Price</h2>
            <p><strong>Rs <?php echo number_format($total_price, 2); ?></strong></p>

            <!-- Hidden fields for submission -->
            <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>">

            <?php foreach ($products as $product): ?>
                <input type="hidden" name="products[<?php echo htmlspecialchars($product['product_id']); ?>][cart_id]" value="<?php echo htmlspecialchars($product['cart_id']); ?>">
                <input type="hidden" name="products[<?php echo htmlspecialchars($product['product_id']); ?>][category_id]" value="<?php echo htmlspecialchars($product['category_id']); ?>">
                <input type="hidden" name="products[<?php echo htmlspecialchars($product['product_id']); ?>][quantity]" value="<?php echo htmlspecialchars($product['quantity']); ?>">
            <?php endforeach; ?>

            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">

            <button type="submit" class="btn">Confirm Order</button>
            <a href="../cart/cart.php" class="btn btn-secondary">Back to Cart</a>
        </form>
    </div>
</body>

</html>
