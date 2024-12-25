<?php
session_start();
error_reporting(0);
include '../connection/connection.php';

// Check if the Category_id is set via POST, if not, redirect
if (!isset($_POST['Category_id']) && !isset($_POST['Category_name'])) {
    header("Location: category.php");
    exit();
}

$Category_id = $_POST['Category_id'];
$Category_name = $_POST['Category_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
</head>

<style>
    .contact-us {
        padding-top: 50px;
        padding-bottom: 50px;
    }

    h1 {
        color: #ffffff;
        text-align: center;
        font-size: 36px;
        font-weight: 600;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 0;
    }

    .card-text {
        font-size: 14px;
        color: #555;
        margin-bottom: 0;
    }

    .card-text.price {
        font-size: 16px;
        font-weight: bold;
        color: #d24ebb;
    }

    .btn-primary {
        background-color: #d24ebb;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #c13c9e;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .col-lg-3,
    .col-md-6,
    .col-sm-12 {
        flex: 1 1 23%;
        margin: 15px;
        max-width: 300px;
    }

    @media (max-width: 768px) {
        .col-lg-3,
        .col-md-6 {
            flex: 1 1 48%;
        }

        .col-sm-12 {
            flex: 1 1 100%;
        }

        .card-body {
            padding: 15px;
        }
    }

    @media (max-width: 480px) {
        .col-lg-3,
        .col-md-6 {
            flex: 1 1 100%;
        }

        .card-body {
            padding: 10px;
        }

        h1 {
            font-size: 28px;
        }
    }
</style>

<body>
    <?php include '../header_footer/header.php'; ?>

    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div>
                        <h1 style="margin-top: 15px; margin-left: 520px; padding-bottom: 20px;">
                            <?php echo $Category_name; ?>
                        </h1>
                    </div>
                </div>

                <div class="" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div class="row" style="margin-left: 200px;">
                        <?php
                        // Use prepared statement to prevent SQL injection
                        $query = "SELECT * FROM product WHERE Category_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('i', $Category_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-lg-3 col-md-6 col-sm-12" style="width: 300px;">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <img src="../admin/dist/<?php echo $row['Product_image']; ?>">
                                            <h2 class="card-title" style="margin-top: -87px; margin-left: -175px;">
                                                <?php echo $row['Product_name']; ?>
                                            </h2>
                                            <p class="card-text" style="height: 100px;">
                                                <?php echo $row['Product_description']; ?>
                                            </p>
                                            <br>
                                            <p><b>Price Of This Service</b></p>
                                            <p class="card-text">
                                                <?php echo $row['Product_price']; ?> per Hour
                                            </p>
                                            <p><b>Available Quantity:</b> <?php echo $row['quantity']; ?></p>
                                            <form method="post" action="../cart/add_to_cart.php">
                                                <input type="hidden" name="category_id" value="<?php echo $Category_id; ?>">
                                                <input type="hidden" name="sub_service_id" value="<?php echo $row['Product_id']; ?>">
                                                <input type="hidden" name="sub_service_name" value="<?php echo $row['Product_name']; ?>">
                                                <input type="hidden" name="service_id" value="<?php echo $Category_id; ?>">
                                                <input type="hidden" name="sub_service_price" value="<?php echo $row['Product_price']; ?>">

                                                <!-- Disable button if quantity is 0 -->
                                                <input type="submit" 
                                                       class="btn btn-primary" 
                                                       value="<?php echo ($row['quantity'] == 0) ? 'Out of Stock' : 'Add to cart'; ?>" 
                                                       <?php echo ($row['quantity'] == 0) ? 'disabled' : ''; ?>>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<h1>No sub-services available for this service.</h1>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
