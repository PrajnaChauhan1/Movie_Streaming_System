<?php
include 'session.php';
if (!isActiveAdmin() && !isActiveUser()) {
    header("Location: index.php?error=Please Login");
    exit();
}

if (!isset($_GET["category"]) || empty($_GET["category"])) {
    header("Location: index.php");
    exit();
}

$category = htmlspecialchars($_GET["category"]);

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'movies';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM movies WHERE category = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="css/searchpage.css">
</head>

<body>
    <div class="search-results">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $movie_title = htmlspecialchars($row['name']);
                $casts = htmlspecialchars($row['casts']);
                $release_date = htmlspecialchars($row['release_date']);
                $movieId = $row['id'];
                echo '<a href="viewmovie.php?movieId=' . $movieId . '">';
                echo '<div class="movie">';
                echo '<img src="thumbnails/' . $movie_title . '.png">';
                echo '<h2>Movie name: ' . $movie_title . '</h2>';
                echo '<p>Release Date: ' . $release_date . '</p>';
                echo '<p>Cast: ' . $casts . '</p>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "Movie not found.";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>

</html>
