<?php
include 'session.php';
if (!isActiveAdmin() && !isActiveUser()) {
    header("Location: index.php?error=Please Login");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['movieId'])) {
    $movieId = $_GET['movieId'];
} else {
    echo 'Invalid movie id';
    exit(); // Exit if no movie ID is provided
}

$sql = "SELECT name, release_date, casts FROM movies WHERE id = $movieId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $movieName = $row["name"];
    $releaseDate= $row["release_date"];
    $casts= $row["casts"];
} else {
    $movieName = "Default Movie Name";
}

$query = "SELECT r.review, u.full_name AS username FROM reviews r INNER JOIN user u ON r.user_id = u.id WHERE r.movie_id = $movieId";
$result = mysqli_query($conn, $query);

$reviews = []; // Initialize an empty array to hold reviews

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch reviews and store them in the $reviews array
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Streaming and Review Page</title>
    <link rel="stylesheet" href="css/viewmovie.css">
</head>

<body>
    <div class="container">
    
        <div class="video-container">
            <video width="1080" height="600" controls controlsList="nodownload" disablePictureInPicture>
                <source src="movies/<?php echo $movieName; ?>.mp4" type="video/mp4">
            </video>
            <h3>Currently Streaming: <?php echo $movieName; ?></h3>
            <h3>Cast:   <?php echo $casts; ?></h3>
            <h3>Release Date:  <?php echo $releaseDate; ?></h3>
        </div>
        <?php
            if(isset($_GET['error'])) {
            echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            ?>
        <?php
        if (isActiveUser()) {
            ?>
            <form class="review-box" action="postReview.php?movieId=<?php echo $movieId; ?>" method="post">
                <h2>Write a Review</h2>
                <textarea id="review-text" placeholder="Write your review" name="review-text" maxlength="2000"></textarea>
                <button type="submit">Post Review</button>
            </form>
        <?php
        }
        ?>

        <div class="reviews">
            <h3>Reviews</h3>
            <?php
            foreach ($reviews as $review) {
                echo '<div class="review">';
                echo '<p class="username"><strong>' . htmlspecialchars($review['username']) . ':</strong></p>';
                echo '<p class="review-text">' . htmlspecialchars($review['review']) . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>


</html>
