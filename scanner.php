<?php
error_reporting(0);
// Include necessary files
include 'connection/connection.php';  // Database connection
session_start();

// Check if delivery personnel is logged in
if (!isset($_SESSION['delivery_login'])) {
    echo "<script>alert('Please login to view.'); window.location.href='../login/login.php';</script>";
    exit();
}

$delivery_id = $_SESSION['delivery_id'];  // Get the logged-in delivery personnel's ID
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner / Reader</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        padding: 0;
        height: 100vh;
        box-sizing: border-box;
        text-align: center;
        background: rgb(128 0 0 / 66%);
    }

    .container {
        width: 100%;
        max-width: 500px;
        margin: 5px;
    }

    .container h1 {
        color: #ffffff;
    }

    .section {
        background-color: #ffffff;
        padding: 50px 30px;
        border: 1.5px solid #b2b2b2;
        border-radius: 0.25em;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.25);
    }

    #my-qr-reader {
        padding: 20px !important;
        border: 1.5px solid #b2b2b2 !important;
        border-radius: 8px;
    }

    video {
        width: 100% !important;
        border: 1px solid #b2b2b2 !important;
        border-radius: 0.25em;
    }

    #message {
        margin-top: 20px;
        font-weight: bold;
    }

    #success-animation {
        display: none;
        margin-top: 20px;
        font-size: 24px;
        color: green;
        animation: fadeInOut 3s ease-in-out;
    }

    @keyframes fadeInOut {
        0% { opacity: 0; }
        20% { opacity: 1; }
        80% { opacity: 1; }
        100% { opacity: 0; }
    }
</style>

<script>
    function domReady(fn) {
        if (
            document.readyState === "complete" ||
            document.readyState === "interactive"
        ) {
            setTimeout(fn, 1000);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    domReady(function () {
        function onScanSuccess(decodeText) {
            try {
                const orderData = JSON.parse(decodeText);

                // Extract order ID
                const orderId = orderData.order_id;

                // Send AJAX request to update order status
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "update_order_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function () {
                    const message = document.getElementById('message');
                    const scanner = document.getElementById('my-qr-reader');
                    const successAnimation = document.getElementById('success-animation');

                    if (xhr.status === 200) {
                        // Hide scanner and show success animation
                        scanner.style.display = "none";
                        message.style.display = "none";
                        successAnimation.style.display = "block";
                        successAnimation.innerText = xhr.responseText;

                        // Redirect to index.php after 3 seconds
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 3000);
                    } else {
                        message.innerText = "Error updating the order status. Please try again.";
                        message.style.color = "red";
                    }
                };

                xhr.send("order_id=" + orderId);
            } catch (error) {
                const message = document.getElementById('message');
                message.innerText = "Invalid QR Code data. Please try again.";
                message.style.color = "red";
                console.error("Error parsing JSON:", error);
            }
        }

        let htmlscanner = new Html5QrcodeScanner(
            "my-qr-reader", {
                fps: 10,
                qrbox: 250,
            }
        );
        htmlscanner.render(onScanSuccess);
    });
</script>

<body>
    <div class="container">
        <h1>Scan QR Codes</h1>
        <div class="section">
            <div id="my-qr-reader"></div>
            <p id="message"></p>
            <div id="success-animation">Order marked as completed!</div>
        </div>
    </div>
</body>

</html>
