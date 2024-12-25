<?php
// Include database connection
include '../connection/connection.php';
error_reporting(0);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // First, try to login as a customer
    $sql_customer = "SELECT * FROM customer WHERE email = ?";
    $stmt = $conn->prepare($sql_customer);
    $stmt->bind_param('s', $username);

    $stmt->execute();
    $result_customer = $stmt->get_result();

    if ($result_customer->num_rows > 0) {
        $user = $result_customer->fetch_assoc();

        // Use password verification for customer
        if (password_verify($password, $user['password'])) {
            // Store customer details in session
            $_SESSION['user_id'] = $user['customer_id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['login'] = 'customer_login';

            header('Location: ../services/category.php'); // Redirect to the customer category page
            exit();
        } else {
            $error_message = "Invalid password for customer. Please try again.";
        }
    } else {
        // If no customer found, check for admin login
        $sql_admin = "SELECT * FROM admin WHERE admin_email_id = ?";
        $stmt_admin = $conn->prepare($sql_admin);
        $stmt_admin->bind_param('s', $username);

        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        if ($result_admin->num_rows > 0) {
            $admin = $result_admin->fetch_assoc();

            // For admin, compare passwords directly (without hashing)
            if ($password == $admin['admin_password']) {
                // Store admin details in session
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['admin_name'] = $admin['admin_name'];
                $_SESSION['admin_email'] = $admin['admin_email_id'];
                $_SESSION['admin_login'] = 'admin_login';

                header('Location: ../admin/dist/index.php'); // Redirect to the admin dashboard
                exit();
            } else {
                $error_message = "Invalid password for admin. Please try again.";
            }
        } else {
            // If no admin found, check for delivery personnel login
            $sql_delivery_personnel = "SELECT * FROM DeliveryPersonnel WHERE email = ?";
            $stmt_delivery = $conn->prepare($sql_delivery_personnel);
            $stmt_delivery->bind_param('s', $username);

            $stmt_delivery->execute();
            $result_delivery = $stmt_delivery->get_result();

            if ($result_delivery->num_rows > 0) {
                $delivery_personnel = $result_delivery->fetch_assoc();

                // Use password verification for delivery personnel
                if (password_verify($password, $delivery_personnel['Password'])) {
                    // Store delivery personnel details in session
                    $_SESSION['delivery_id'] = $delivery_personnel['DeliveryPersonnelID'];
                    $_SESSION['delivery_name'] = $delivery_personnel['FullName'];
                    $_SESSION['delivery_email'] = $delivery_personnel['Email'];
                    $_SESSION['delivery_login'] = 'delivery_login';

                    header('Location: ../scanner.php'); // Redirect to the delivery dashboard
                    exit();
                } else {
                    $error_message = "Invalid password for delivery personnel. Please try again.";
                }
            } else {
                $error_message = "No account found with that email for customer, admin, or delivery personnel. Please check your credentials.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include '../header_footer/header.php';
    ?>

    <div class="login-container">
        <form action="login.php" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="username">Username (Email)</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit">Login</button>
            <p id="errorMessage"><?php echo isset($error_message) ? $error_message : ''; ?></p>
        </form>
        <p class="register-message">
            Don't have an account? <a href="../registration/registration.php">Create one</a>.
        </p>
    </div>
</body>

</html>
