<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="registration.css">
    <script>
        // JavaScript validation function
        function validateForm() {
            let name = document.getElementById("name").value;
            let phone = document.getElementById("phone").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let dob = document.getElementById("date_of_birth").value;
            let gender = document.getElementById("gender").value;
            let address = document.getElementById("address").value;  // Address field
            let errorMessage = "";

            // Validate Name
            if (name == "") {
                errorMessage += "Name is required.\n";
            }

            // Validate Phone
            if (phone == "") {
                errorMessage += "Phone number is required.\n";
            } else if (!/^\d{10}$/.test(phone)) {  // Ensure phone is 10 digits
                errorMessage += "Phone number must be 10 digits.\n";
            }

            // Validate Email
            if (email == "") {
                errorMessage += "Email is required.\n";
            } else if (!/\S+@\S+\.\S+/.test(email)) {  // Validate email format
                errorMessage += "Please enter a valid email address.\n";
            }

            // Validate Password
            if (password == "") {
                errorMessage += "Password is required.\n";
            } else if (password.length < 6) {  // Ensure password is at least 6 characters
                errorMessage += "Password must be at least 6 characters.\n";
            }

            // Validate Date of Birth
            if (dob == "") {
                errorMessage += "Date of Birth is required.\n";
            }

            // Validate Gender
            if (gender == "") {
                errorMessage += "Gender is required.\n";
            }

            // Validate Address
            if (address == "") {
                errorMessage += "Address is required.\n";
            }

            // Display error messages if any
            if (errorMessage != "") {
                alert(errorMessage);  // Display validation errors in an alert
                return false;  // Prevent form submission
            }

            return true;  // Allow form submission
        }
    </script>
</head>

<body>
    <?php
    include '../header_footer/header.php';
    ?>

    <div class="registration-container">
        <h2>Customer Registration</h2>
        <form action="registrationProcess.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
    </div>
</body>

</html>
