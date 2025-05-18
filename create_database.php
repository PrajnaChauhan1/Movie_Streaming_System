<?php

$dbHost = 'localhost'; 
$dbUsername = 'root'; 
$dbPassword = ''; 
$dbName = 'Movies'; 

// Connect to MySQL server
$conn = new mysqli($dbHost, $dbUsername, $dbPassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists
$result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbName'");

if ($result->num_rows == 0) {
    // Database does not exist, create it
    $sql = "CREATE DATABASE $dbName";
    if ($conn->query($sql) === TRUE) {
        // Select the newly created database
        $conn->select_db($dbName);
    } else {

    }
} else {
    // Database exists, select it
    $conn->select_db($dbName);
}

function createOrAlterTable($conn, $tableName, $columns)
{
    $sql = "CREATE TABLE IF NOT EXISTS $tableName (id INT AUTO_INCREMENT PRIMARY KEY, $columns)";
    if ($conn->query($sql) === FALSE) {
        
    }
}

// Create or alter User table
createOrAlterTable($conn, "user", "full_name VARCHAR(255), phone VARCHAR(15), email VARCHAR(255), age INT, password VARCHAR(255), role VARCHAR(255)");

// Create or alter Movies table
createOrAlterTable($conn, "movies", "name VARCHAR(255), release_date DATE, length TIME, casts TEXT, category VARCHAR(255), reviews VARCHAR(500)");

// Create Reviews table with foreign keys
createOrAlterTable($conn, "reviews", "user_id INT, movie_id INT, review VARCHAR(500), FOREIGN KEY (user_id) REFERENCES User(id), FOREIGN KEY (movie_id) REFERENCES Movies(id)");

// Close MySQL connection
$conn->close();
?>