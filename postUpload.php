<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$movieName = isset($_POST['movieName']) ? $_POST["movieName"] : "";
$casts = isset($_POST['casts']) ? $_POST["casts"] : "";
$releaseDate = isset($_POST['releaseDate']) ? $_POST["releaseDate"] : "";
$category = isset($_POST['category']) ? $_POST["category"] : "";

// File upload logic
$thumbnailTargetDir = "thumbnails/"; 
$movieTargetDir = "movies/"; 
$thumbnailFileType = strtolower(pathinfo($_FILES['thumbnail']["name"], PATHINFO_EXTENSION));
$movieFileType = strtolower(pathinfo($_FILES['movie']["name"], PATHINFO_EXTENSION));

// Rename uploaded files to match movie name
$thumbnailFileName = $movieName . "." . $thumbnailFileType;
$movieFileName = $movieName . "." . $movieFileType;

$targetThumbnail = $thumbnailTargetDir . $thumbnailFileName;
$targetMovie = $movieTargetDir . $movieFileName;

$checkQuery = "SELECT * FROM movies WHERE release_date='$releaseDate' AND name='$movieName'";
$result = $conn->query($checkQuery);

if ($result->num_rows > 0) {
    header("Location: upload.php?error=Sorry! Movie already exists with that release date and Name.");
    exit();
}
// Upload files
if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $targetThumbnail)) {
    
} else {
    header("Location: upload.php?error=Something went wrong while uploading the movie.");
    exit();
}

if (move_uploaded_file($_FILES["movie"]["tmp_name"], $targetMovie)) {
   
} else {
    header("Location: upload.php?error=Something went wrong while uploading the movie.");
    exit();
}

// Prepare SQL statement with paths for both files
$sql = "INSERT INTO movies (name, casts, release_date, category)
VALUES ('$movieName', '$casts', '$releaseDate', '$category')";

// Insert data into database
if ($conn->query($sql) === TRUE) {
    header("Location: admindashboard.php?success=Movie Uploaded Successfully");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
