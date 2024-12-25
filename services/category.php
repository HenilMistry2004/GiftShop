<?php
session_start();
error_reporting(0);
include '../connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="gift.css"> <!-- External stylesheet -->
</head>

<body>
<?php
 include '../header_footer/header.php';
?>

    <div class="main-container">
        <div class="category-row">
            <?php
            $query = "SELECT * FROM category WHERE status ='active'";
            $query_run = mysqli_query($conn, $query);
            if ($query_run->num_rows > 0) {
                while ($row = $query_run->fetch_assoc()) {
            ?>
                    <div>
                        <div class="category-card">
                            <div>
                                <img src="../admin/dist/<?php echo $row['Image']; ?>" alt="<?php echo $row['Category_name']; ?>" class="card-img-top">
                            </div>
                            <div class="category-card-body">
                                <h2 class="card-title" style="padding: 0; text-align: left; padding-left: 8px; padding-right: 8px; margin-bottom : 0px;" ><?php echo $row['Category_name']; ?></h2>
                                <form method="post" action="sub_Category.php"  style="margin-top: -23px;">
                                    <input type="hidden" name="Category_id" value="<?php echo $row['Category_id']; ?>">
                                    <input type="hidden" name="Category_name" value="<?php echo $row['Category_name']; ?>">
                                    <input type="submit" class="btn btn-primary" value="Book Now">
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No active services available.</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>
