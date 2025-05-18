<?php
include 'session.php';
if (!isActiveAdmin()) {
    // If no active user, redirect to login page
    header("Location: index.php?error=Please Login");
    exit(); // Make sure to stop further execution
}

// Assuming you have your database credentials defined elsewhere
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

// Function to sanitize input to prevent SQL injection
function sanitize($input) {
    global $conn;
    return $conn->real_escape_string($input);
}

// Retrieve movie details based on movie ID
if(isset($_GET['movieId'])) {
    $movieId = sanitize($_GET['movieId']);
    $sql = "SELECT * FROM movies WHERE id = $movieId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $movieName = $row['name'];
        $releaseDate = $row['release_date'];
        $casts = $row['casts'];
        $category = $row['category'];
    } else {
        echo "No movie found with that ID";
    }
}
$conn->close();
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
        
        <h1>Edit Movie Details</h1>
        <form action="postedit.php" method="post" enctype="multipart/form-data">
        <?php
            if(isset($_GET['error'])) {
            echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            ?>
            <?php
            if (isset($_GET['success'])) {
                echo '<p style="color: green; margin-left:15%">' . htmlspecialchars($_GET['success']) . '</p>';
            }
            ?>
            <div>
                <label>Name of the Movie:</label><br>
                <input name="movieId" value="<?php echo isset($movieId) ? $movieId : ''; ?>" required hidden>
                <input type="text" id="movieName" name="movieName" value="<?php echo isset($movieName) ? $movieName : ''; ?>" required>
            </div>
            <div>
                <label>Release Date:</label><br>
                <input type="date" id="releaseDate" name="releaseDate" value="<?php echo isset($releaseDate) ? $releaseDate : ''; ?>" required>
            </div>
            <div>
                <label>Enter the Movie Main Casts</label><br>
                <input type="text" id="casts" name="casts" value="<?php echo isset($casts) ? $casts : ''; ?>" required>
            </div>
            <label>Category of the Movie</label>
            <div class="category">
                <select id="Category" class="Category" name="category" required>
                    <option value="Hollywood" <?php echo (isset($category) && $category == 'Hollywood') ? 'selected' : ''; ?>>Hollywood</option>
                    <option value="Bollywood" <?php echo (isset($category) && $category == 'Bollywood') ? 'selected' : ''; ?>>Bollywood</option>
                    <option value="Documentary" <?php echo (isset($category) && $category == 'Documentary') ? 'selected' : ''; ?>>Documentary</option>
                    <option value="Nepali" <?php echo (isset($category) && $category == 'Nepali') ? 'selected' : ''; ?>>Nepali Movie</option>
                </select>
            </div>

            <button type="submit">Confirm</button>

        </form>
    </div>
</body>
<script src="javascript/upload.js"></script>
</html>
