<?php
include 'session.php';
if (!isActiveAdmin()) {
    // If no active user, redirect to login page
    header("Location: index.php?error=Please Login");
    exit(); // Make sure to stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Upload Form</title>
    <link rel="stylesheet" href="css/upload.css">
</head>

<body>
    <div class="upload-form">

        <h1>Upload Movies</h1>
        <form action="postUpload.php" method="post" enctype="multipart/form-data">
            <?php
            if (isset($_GET['error'])) {
                echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            ?>
            <?php
            // Check if there's an error message to display
            if (isset($_GET['success'])) {
                echo '<p style="color: green; margin-left:15%">' . htmlspecialchars($_GET['success']) . '</p>';
            }
            ?>
            <div>
                <div>
                    <label>Select Thumbnail (PNG only):</label>
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/png" required>
                </div>
                <div>
                    <label>Select Movie File (MP4 only):</label>
                    <input type="file" id="movie" name="movie" accept="video/mp4" required>
                </div>

                <div>
                    <label>Name of the Movie:</label><br>
                    <input type="Text" id="movieName" name="movieName" required>
                </div>
                <div>
                    <label>Release Date:</label><br>
                    <input type="date" id="releaseDate" name="releaseDate" required>
                </div>
                <div>
                    <label>Enter the Movie Main Casts</label><br>
                    <input type="text" id="casts" name="casts" required>
                </div>
                <label>Category of the Movie</label>
                <div class="category">
                    <select id="Category" class="Category" name="category" required>
                        <option value="Hollywood">Hollywood</option>
                        <option value="Bollywood">Bollywood</option>
                        <option value="Documentry">Documentry</option>
                        <option value="Nepali">Nepali Movie</option>
                    </select>
                </div>

                <button type="submit">Upload</button>

        </form>
    </div>
</body>
<script src="javascript/upload.js"></script>

</html>