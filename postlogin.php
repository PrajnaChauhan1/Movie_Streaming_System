<?php
include 'session.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];
    $role = $row['role'];

    if (password_verify($password, $hashed_password)) {

        if ($role == 'admin') {
            removeActiveUser();
            addActiveAdmin($email);
            header("Location: admindashboard.php");
            exit();
        } else {
            removeActiveAdmin();
            addActiveUser($email);
            header("Location: homepage.php");
            exit();
        }

    } else {
        header("Location: index.php?error=Invalid password");
    }
} else {
    
    header("Location: index.php?error=User does not exist");
}


$conn->close();
