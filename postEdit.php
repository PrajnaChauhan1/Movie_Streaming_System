<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$movieId = isset($_POST['movieId']) ? $_POST["movieId"] : "";
$movieName = isset($_POST['movieName']) ? $_POST["movieName"] : "";
$length = isset($_POST['length']) ? $_POST["length"] : ""; 
$casts = isset($_POST['casts']) ? $_POST["casts"] : "";
$releaseDate = isset($_POST['releaseDate']) ? $_POST["releaseDate"] : "";
$category = isset($_POST['category']) ? $_POST["category"] : "";

if (empty($movieId)) {
    echo "Error: Movie ID not provided.";
    exit(); 
}

// Fetch the original movie details to get the original filenames
$sql = "SELECT * FROM movies WHERE id='$movieId'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $originalMovie = $result->fetch_assoc();
    $originalMovieName = $originalMovie['name'];
    $originalReleaseDate = $originalMovie['release_date'];
} else {
    echo "Error: Movie not found.";
    exit();
}

$originalThumbnailPath = "thumbnails/" . $originalMovieName . ".png";
$originalMoviePath = "movies/" . $originalMovieName . ".mp4";

$newThumbnailPath = "thumbnails/" . $movieName . ".png";
$newMoviePath = "movies/" . $movieName . ".mp4";

// Rename the files if they exist and log any errors
if (file_exists($originalThumbnailPath)) {
    if (!rename($originalThumbnailPath, $newThumbnailPath)) {
        
    }
} else {
   
}

if (file_exists($originalMoviePath)) {
    if (!rename($originalMoviePath, $newMoviePath)) {
       
    }
} else {
   
}

// Update the movie details in the database
$sql = "UPDATE movies SET name='$movieName', casts='$casts', release_date='$releaseDate', category='$category' WHERE id='$movieId'";

if ($conn->query($sql) === TRUE) {
    header("Location: admindashboard.php?success=Movie Updated Successfully");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

