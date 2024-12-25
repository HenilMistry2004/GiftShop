<?php
session_start();
include '../connection/connection.php';


// Fetch the cart count if the user is logged in
$cart_count = 0;
if (isset($_SESSION['login']) && $_SESSION['login'] == 'login') {
    $user_id = $_SESSION['user_id'];
    // Get the count of items in the cart where status is 'not ordered'
    $query = "SELECT SUM(quantity) as cart_count FROM cart WHERE customer_id = ? AND status = 'not ordered'"; // Added condition for 'not ordered'
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $cart_count = $row['cart_count'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="icon" href="../images/favicon.ico" />
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <link rel="stylesheet" href="../css/touchTouch.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="heaserStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-migrate-1.1.1.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/superfish.js"></script>
    <script src="../js/jquery.equalheights.js"></script>
    <script src="../js/jquery.mobilemenu.js"></script>
    <script src="../js/tmStickUp.js"></script>
    <script src="../js/jquery.ui.totop.js"></script>
    <script src="../js/touchTouch.jquery.js"></script>
    <script src="../js/jquery.shuffle-images.js"></script>

    <script>
        $(window).load(function() {
            $().UItoTop({
                easingType: "easeOutQuart"
            });
            $(".gallery .info").touchTouch();
        });

        $(document).ready(function() {
            $(".shuffle-me").shuffleImages({
                target: ".images > img",
            });
        });
    </script>
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <h1>
                        <a href="../index.php">
                            <img src="../images/logo.png" alt="Logo alt" />
                        </a>
                    </h1>
                    <div class="navigation">
                        <nav>
                            <ul class="sf-menu">
                                <li class="current"><a href="../index.php">Home</a></li>
                                <li><a href="../services/category.php">Category</a></li>
                                <?php if (isset($_SESSION['login']) && $_SESSION['login'] == 'customer_login'): ?>
                                    <li>
                                        <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                    </li>
                                    <li><a href="../login/logout.php">
                                            Sign Out
                                        </a>
                                    </li>

                                    <li><a href="../orders/order_history.php">Order History</a></li>

                                <?php else: ?>
                                    <li>
                                        <a href="../login/login.php">
                                            <input type="button" value="Login" style="height: 36px; width: 83px; border-radius: 13px; background-color: #d24ebb; font: 600 22px / 36px 'Dosis', sans-serif;">
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li>
                                    <a href="../cart/cart.php">
                                        <i class="fa fa-shopping-cart" style="font-size:24px"></i>
                                        <?php if ($cart_count > 0): ?>
                                            <span class="cart-count"><?php echo $cart_count; ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>

                            </ul>
                        </nav>
                        <div class="clear"></div>
                    </div>
                    <!-- Shopping Cart Icon with Item Count -->

                </div>
            </div>
        </div>
    </header>
</body>

</html>
