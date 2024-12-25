<?php
error_reporting(0);
// Include necessary files
include '../connection/connection.php';  // Database connection
include '../header_footer/header.php';

session_start();

// Check if customer is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to view your orders.'); window.location.href='../login/login.php';</script>";
    exit();
}

$customer_id = $_SESSION['user_id'];  // Get logged-in customer's ID

// Fetch orders
$query = "
    SELECT 
        orders.order_id, 
        product.Product_name, 
        category.Category_name, 
        orders.quantity, 
        orders.total_price, 
        orders.order_date, 
        orders.status 
    FROM orders
    JOIN product ON orders.product_id = product.Product_id
    JOIN category ON orders.category_id = category.Category_id
    WHERE orders.customer_id = ?
    ORDER BY orders.status ASC, orders.order_date ASC"; // Ensure orders are grouped by status

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

// Separate orders by status
$completed_orders = [];
$other_orders = [];

while ($order = $result->fetch_assoc()) {
    if ($order['status'] === 'order_completed') {
        $completed_orders[] = $order;
    } else {
        $other_orders[] = $order;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>

    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .order-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 15px 0;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-details {
            flex: 1;
            padding-right: 20px;
        }
        .order-details p {
            margin: 5px 0;
        }
        .order-details .title {
            font-weight: bold;
            font-size: 18px;
        }
        .qrcode-container {
            width: 120px;
            height: 120px;
            text-align: center;
        }
        .show-qrcode-btn {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .show-qrcode-btn[disabled] {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<h1>Your Order History</h1>

<!-- Display orders -->
<?php foreach (array_merge($other_orders, $completed_orders) as $order): ?>
    <div class="order-card">
        <div class="order-details">
            <p class="title"><?php echo $order['Product_name']; ?></p>
            <p><strong>Order ID:</strong> <?php echo $order['order_id']; ?></p>
            <p><strong>Category:</strong> <?php echo $order['Category_name']; ?></p>
            <p><strong>Quantity:</strong> <?php echo $order['quantity']; ?></p>
            <p><strong>Total Price:</strong> Rs<?php echo number_format($order['total_price'], 2); ?></p>
            <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
            <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
        </div>
        <button 
            class="show-qrcode-btn" 
            onclick="showQRCode('<?php echo $order['order_id']; ?>', '<?php echo $order['Product_name']; ?>', '<?php echo $order['total_price']; ?>')" 
            <?php echo ($order['status'] === 'order_completed') ? 'disabled' : ''; ?>>
            Show QR Code
        </button>
    </div>
<?php endforeach; ?>

<!-- QR Code Modal -->
<div id="qrcode-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:#fff; padding:20px; border-radius:8px; text-align:center;">
        <h3>QR Code</h3>
        <div id="qrcode-container"></div>
        <button onclick="closeQRCode()" style="margin-top:10px; padding:10px 20px; background:#dc3545; color:white; border:none; border-radius:4px;">Close</button>
    </div>
</div>

<script>
    function showQRCode(orderId, productName, price) {
        // Display the modal
        const modal = document.getElementById('qrcode-modal');
        modal.style.display = 'flex';

        // Generate the QR code
        const qrcodeContainer = document.getElementById('qrcode-container');
        qrcodeContainer.innerHTML = ''; // Clear any existing QR code
        new QRCode(qrcodeContainer, {
            text: JSON.stringify({
                order_id: orderId,
                product_name: productName,
                price: price
            }),
            width: 150,
            height: 150,
            colorDark: "#000000",
            colorLight: "#ffffff"
        });
    }

    function closeQRCode() {
        // Hide the modal
        const modal = document.getElementById('qrcode-modal');
        modal.style.display = 'none';
    }
</script>

</body>
</html>
