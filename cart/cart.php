<?php
session_start();
error_reporting(0);
include '../connection/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header('Location: ../login/login.php'); // Redirect to login page if not logged in
    exit();
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Fetch cart details from the database where status = 'not ordered'
$query = "SELECT cart.cart_id, product.Product_id, product.Product_name, product.Product_price, product.Product_image, cart.quantity, product.category_id 
          FROM cart 
          INNER JOIN product ON cart.product_id = product.Product_id 
          WHERE cart.customer_id = ? AND cart.status = 'not ordered'"; // Added condition for 'not ordered'
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="../notification/notification.css"> <!-- Include notification styles -->
    <!-- FontAwesome for the trash icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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

        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .delete-icon {
            font-size: 20px;
            color: #e74c3c;
            cursor: pointer;
            border: none;
            background: none;
        }

        .delete-icon:hover {
            color: #c0392b;
        }
    </style>
</head>

<body>

    <?php include '../header_footer/header.php'; ?>

    <div class="container">
        <h1>My Cart</h1>

        <?php if (count($cart_items) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th> <!-- Column for item number -->
                        <th>Cart ID</th> <!-- Display Cart ID -->
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product ID</th> <!-- Display Product ID -->
                        <th>Category Id</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $index = 1; // Initialize index for item number
                    foreach ($cart_items as $item): ?>
                        <?php $total_price += $item['Product_price'] * $item['quantity']; ?>
                        <tr>
                            <td><?php echo $index++; ?></td> <!-- Display the item number -->
                            <td><?php echo $item['cart_id']; ?></td> <!-- Display Cart ID -->
                            <td><img src="../admin/dist/<?php echo $item['Product_image']; ?>" alt="<?php echo $item['Product_name']; ?>" style="width: 80px; height: auto;"></td>
                            <td><?php echo $item['Product_name']; ?></td>
                            <td><?php echo $item['Product_id']; ?></td> <!-- Display the Product ID -->
                            <td><?php echo $item['category_id']; ?></td> <!-- Display the category ID -->
                            <td>Rs<?php echo number_format($item['Product_price'], 2); ?></td>
                            <td>
                                <button class="decrement" type="button" data-cart-id="<?php echo $item['cart_id']; ?>">-</button>
                                <input type="text" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 60px;" class="quantity-input" data-cart-id="<?php echo $item['cart_id']; ?>">
                                <button class="increment" type="button" data-cart-id="<?php echo $item['cart_id']; ?>">+</button>
                            </td>
                            <td>
                                <!-- Delete icon instead of remove button -->
                                <button class="delete-icon" data-cart-id="<?php echo $item['cart_id']; ?>"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

            <div class="total">
                Total Price: Rs<?php echo number_format($total_price, 2); ?>
            </div>

            <div class="checkout" style="text-align: right; margin-top: 20px;">
                <form action="../orders/orders.php" method="POST">
                    <!-- Hidden fields for user and cart details -->
                    <input type="hidden" name="customer_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <input type="hidden" name="customerName" value="<?php echo $_SESSION['username']; ?>">
                    <input type="hidden" name="order_email" value="<?php echo $_SESSION['email']; ?>">
                    <input type="hidden" name="order_phone" value="<?php echo $_SESSION['phone']; ?>">
                    <input type="hidden" name="order_address" value="<?php echo $_SESSION['address']; ?>">

                    <!-- Hidden fields for cart items -->
                    <?php foreach ($cart_items as $item): ?>
                        <input type="hidden" name="products[<?php echo $item['cart_id']; ?>][cart_id]" value="<?php echo $item['cart_id']; ?>">
                        <input type="hidden" name="products[<?php echo $item['cart_id']; ?>][product_id]" value="<?php echo $item['Product_id']; ?>">
                        <input type="hidden" name="products[<?php echo $item['cart_id']; ?>][category_id]" value="<?php echo $item['category_id']; ?>">
                        <input type="hidden" name="products[<?php echo $item['cart_id']; ?>][quantity]" value="<?php echo $item['quantity']; ?>">
                    <?php endforeach; ?>
                    <input type="hidden" name="total_price" value="<?php echo number_format($total_price, 2); ?>">
                    <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                </form>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <?php include '../header_footer/footer.php'; ?>

    <!-- Include your custom JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle quantity change event
            $('.quantity-input').on('input', function() {
                var cartId = $(this).data('cart-id');
                var quantity = $(this).val();

                // Send AJAX request to update the cart
                $.ajax({
                    url: 'update_cart.php', // File to update cart item
                    type: 'POST',
                    data: {
                        cart_id: cartId, // The cart item ID
                        quantity: quantity // The updated quantity
                    },
                    success: function(response) {
                        var data = JSON.parse(response); // Parse the response JSON
                        var productStock = data.stock; // Get the product stock
                        var totalPrice = data.total_price; // Get the updated total price

                        // Update the stock-dependent behavior for quantity input
                        var incrementButton = $(this).closest('tr').find('.increment');
                        var decrementButton = $(this).closest('tr').find('.decrement');

                        if (quantity >= productStock) {
                            incrementButton.prop('disabled', true); // Disable increment button if quantity is equal to or greater than stock
                        } else {
                            incrementButton.prop('disabled', false); // Enable increment button if quantity is less than stock
                        }

                        if (quantity <= 1) {
                            decrementButton.prop('disabled', true); // Disable decrement button if quantity is 1
                        } else {
                            decrementButton.prop('disabled', false); // Enable decrement button if quantity is greater than 1
                        }

                        // Update the displayed total price
                        $('.total').html('Total Price: Rs' + totalPrice.toFixed(2)); // Update total price
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating cart:", status, error);
                        alert('An error occurred while updating the cart.');
                    }
                });
            });

            // Handle increment button click
            $('.increment').on('click', function() {
                var cartId = $(this).data('cart-id');
                var quantityInput = $(this).closest('tr').find('.quantity-input');
                var currentQuantity = parseInt(quantityInput.val());

                // Send AJAX request to increment the quantity
                $.ajax({
                    url: 'update_cart.php',
                    type: 'POST',
                    data: {
                        cart_id: cartId,
                        quantity: currentQuantity + 1
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var productStock = data.stock;
                        var totalPrice = data.total_price;

                        // Increment quantity if below stock
                        if (currentQuantity < productStock) {
                            quantityInput.val(currentQuantity + 1); // Increment quantity
                            quantityInput.trigger('input'); // Trigger input event to check stock and update total price

                            // Reload the table
                            reloadCartTable();
                        } else {
                            alert("Stock limit reached!");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error updating cart:", error);
                        alert("An error occurred while updating the cart.");
                    }
                });
            });

            // Function to reload the table
            function reloadCartTable() {
                // Assuming the table data is rendered in a specific container
                $.ajax({
                    url: 'cart.php', // Replace with the correct URL to fetch the updated table
                    type: 'GET',
                    success: function(data) {
                        // Replace the container's HTML with the updated cart table
                        $('.checkout').html($(data).find('.checkout').html()); // Update only the cart table section
                    },
                    error: function(xhr, status, error) {
                        console.error("Error reloading table:", error);
                        alert("An error occurred while reloading the cart.");
                    }
                });
            }


            // Handle decrement button click
            $('.decrement').on('click', function() {
                var cartId = $(this).data('cart-id');
                var quantityInput = $(this).closest('tr').find('.quantity-input');
                var currentQuantity = parseInt(quantityInput.val());

                // Send AJAX request to decrement the quantity
                if (currentQuantity > 1) { // Allow decrement only if quantity > 1
                    $.ajax({
                        url: 'update_cart.php',
                        type: 'POST',
                        data: {
                            cart_id: cartId,
                            quantity: currentQuantity - 1
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            var totalPrice = data.total_price;

                            // Update quantity in the UI
                            quantityInput.val(currentQuantity - 1);
                            quantityInput.trigger('input'); // Trigger input event to update total price

                            // Reload the table
                            reloadCartTable();
                        },
                        error: function(xhr, status, error) {
                            console.error("Error updating cart:", error);
                            alert("An error occurred while updating the cart.");
                        }
                    });
                } else {
                    alert("Quantity cannot be less than 1!");
                }
            });

            // Function to reload the table
            function reloadCartTable() {
                // Assuming the table data is rendered in a specific container
                $.ajax({
                    url: 'cart.php', // Replace with the correct URL to fetch the updated table
                    type: 'GET',
                    success: function(data) {
                        // Replace the container's HTML with the updated cart table
                        $('.checkout').html($(data).find('.checkout').html()); // Update only the cart table section
                    },
                    error: function(xhr, status, error) {
                        console.error("Error reloading table:", error);
                        alert("An error occurred while reloading the cart.");
                    }
                });
            }


            // // Handle delete button click
            // $('.delete-icon').on('click', function() {
            //     var cartId = $(this).data('cart-id');

            //     // Send AJAX request to delete the item from cart
            //     $.ajax({
            //         url: 'delete_cart.php', // File to delete cart item
            //         type: 'POST',
            //         data: {
            //             cart_id: cartId
            //         },
            //         success: function(response) {
            //             location.reload(); // Reload page to reflect changes
            //         },
            //         error: function(xhr, status, error) {
            //             console.error("Error deleting item:", status, error);
            //         }
            //     });
            // });
        });

        $(document).ready(function() {
            // Handle delete button click
            $('.delete-icon').on('click', function() {
                var cartId = $(this).data('cart-id');

                // Confirm deletion
                if (confirm("Are you sure you want to remove this item from your cart?")) {
                    // Send AJAX request to delete the item from cart
                    $.ajax({
                        url: 'delete_cart.php', // File to handle deletion
                        type: 'POST',
                        data: {
                            cart_id: cartId,
                            action: 'removed' // Include the action parameter
                        },
                        success: function(response) {
                            if (response.trim() === 'Success') {
                                alert("Item removed successfully!");
                                location.reload(); // Reload page to reflect changes
                            } else {
                                alert("Error removing item from the cart: " + response);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error deleting item:", error);
                            alert("An error occurred while deleting the item.");
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>