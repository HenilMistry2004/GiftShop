<?php
include '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address']; // Capture the address from the form

    // Prepare SQL statement with placeholders
    $sql = "INSERT INTO customer (name, phone, email, password, date_of_birth, gender, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssss", $name, $phone, $email, $password, $date_of_birth, $gender, $address);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Registration successful!";
            header('Location: ../login/login.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
