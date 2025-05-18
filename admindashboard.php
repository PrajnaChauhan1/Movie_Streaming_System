<?php
include 'session.php';
if (!isActiveAdmin()) {
    header("Location: index.php?error=Please Login");
    exit();
}
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'Movies';

// Connect to MySQL server
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch movie details from the database
$sql = "SELECT * FROM movies";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NPFLIX Admin Panel</title>
    <link rel="stylesheet" href="css/admindashboard.css">
</head>

<body>
    <div class="sidebar">
        <div class="heading">
            <h1>NPFLIX </h1>
        </div>
        <div class="lists">
            <ul>
                <li><a href="admindashboard.php">Dashboard</a></li>
                <li><a href="upload.php">Upload</a></li>
            </ul>
        </div>
        <div class="logout-button">
            <li><a href="logout.php">logout</a></li>
        </div>

    </div>

    <div class="content">
        <h2>Movie Management</h2>

        <div class="search-box">
            <input type="text" placeholder="Search movies...">
        </div>

        <div class="movie-list">
            <?php
            $dbHost = 'localhost';
            $dbUsername = 'root';
            $dbPassword = '';
            $dbName = 'Movies';

            // Connect to MySQL server
            $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['delete_movie'])) {
                $movieIdToDelete = $_POST['movie_id'];
                $conn->begin_transaction();
                $deleteReviewsSql = "DELETE FROM Reviews WHERE movie_id = ?";
                $deleteReviewsStmt = $conn->prepare($deleteReviewsSql);
                $deleteReviewsStmt->bind_param("i", $movieIdToDelete);
                $deleteReviewsStmt->execute();
                $deleteReviewsStmt->close();
                $deleteMovieSql = "DELETE FROM Movies WHERE id = ?";
                $deleteMovieStmt = $conn->prepare($deleteMovieSql);
                $deleteMovieStmt->bind_param("i", $movieIdToDelete);
                $deleteMovieStmt->execute();
                if ($deleteMovieStmt->affected_rows > 0) {
                    $conn->commit();
                    echo '<script>window.location.reload();</script>';
                } else {
                    $conn->rollback();
                }

                // Close statement
                $deleteMovieStmt->close();
            }



            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $movieName = $row["name"];
                    $release_date = $row["release_date"];
                    $movieId = $row["id"];
                    $thumbnail = "thumbnails/" . $movieName . ".png";
                    ?>
                    <div class="thumbnail">
                        <a href="viewmovie.php?movieId=<?php echo $movieId; ?>">
                            <img src="<?php echo $thumbnail; ?>" alt="<?php echo $movieName; ?>" width="200" height="200"
                                style="width: 200px !important; height: 200px !important;">
                            <div class="title"><?php echo $movieName; ?></div>
                            <div class="date"><?php echo 'Release Date: '.$release_date; ?></div>
                            <br>
                        </a>
                        <!-- Form for delete action -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="movie_id" value="<?php echo $movieId; ?>">
                            <input type="submit" class="delete" name="delete_movie" value="Delete">
                        </form>
                        <a class="edit" href="edit.php?movieId=<?php echo $movieId; ?>">Edit</a>
                    </div>
                    <?php
                }
            } else {
                echo "No movies found.";
            }
            $conn->close();
            ?>

        </div>
    </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchBox = document.querySelector('.search-box input');
    const thumbnails = document.querySelectorAll('.thumbnail');

    searchBox.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase();

        thumbnails.forEach(function(thumbnail) {
            const title = thumbnail.querySelector('.title').textContent.toLowerCase();
            if (title.includes(searchText)) {
                thumbnail.style.display = 'block';
            } else {
                thumbnail.style.display = 'none';
            }
        });
    });
});

</script>
</html>