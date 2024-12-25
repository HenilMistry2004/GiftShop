<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate QR Code</title>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <style>
        #qrcode {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>QR Code Generator</h1>
    <form onsubmit="generateQRCode(); return false;">
        <label for="data">Enter Text or URL:</label>
        <input type="text" id="data" placeholder="Enter your data" required>
        <input type="submit" value="Generate QR Code">
    </form>
    <div id="qrcode"></div>

    <script>
        function generateQRCode() {
            const data = document.getElementById("data").value;
            const qrCodeContainer = document.getElementById("qrcode");

            // Clear previous QR Code if it exists
            qrCodeContainer.innerHTML = "";

            if (data.trim() !== "") {
                // Generate QR Code
                new QRCode(qrCodeContainer, {
                    text: data,
                    width: 200,
                    height: 200,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                });
            } else {
                alert("Please enter valid data!");
            }
        }
    </script>
</body>
</html>
