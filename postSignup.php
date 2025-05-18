<?php
require 'password.php';
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$age = $_POST['age'];
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// SQL to check if email or phone number already exists
$checkIfExistsQuery = "SELECT COUNT(*) AS count FROM user WHERE email = '$email' OR phone = '$phone'";
$checkIfExistsResult = mysqli_query($conn, $checkIfExistsQuery);
$row = mysqli_fetch_assoc($checkIfExistsResult);
$count = $row['count'];

if ($count > 0) {
    header("Location: signup.php?error=User Already exists");
} else {
    // SQL to insert data into user table
    $sql = "INSERT INTO user (full_name, phone, email, age, password)
    VALUES ('$fullname', '$phone', '$email', '$age', '$hashedPassword')";
    
    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to thank-you.php after successful signup
        header("Location: index.php?success=Account Created Successfully");
        exit();
    } else {
        
    }
}


// Close connection
$conn->close();
?>