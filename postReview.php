<?php
include 'session.php';
if (!isActiveUser()) {
    echo 'Only user can post review';
    exit();
}
function saveReview($movieId, $reviewText) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "movies";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $activeUserEmail = getActiveUser();
    $stmt_select_user = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $stmt_select_user->bind_param("s", $activeUserEmail);
    $stmt_select_user->execute();
    $result_user = $stmt_select_user->get_result();
    if ($row_user = $result_user->fetch_assoc()) {
        $activeUserId = $row_user['id'];
        
        // Check if a review already exists from the same user for the same movie
        $stmt_check_review = $conn->prepare("SELECT id FROM reviews WHERE user_id = ? AND movie_id = ?");
        $stmt_check_review->bind_param("ii", $activeUserId, $movieId);
        $stmt_check_review->execute();
        $result_review = $stmt_check_review->get_result();
        if ($result_review->num_rows > 0) {
            $error_message = "You have already reviewed this movie";
            header("Location: viewmovie.php?movieId=" . urlencode($movieId) . "&error=" . urlencode($error_message));
            $conn->close();
            return;
        }
        
        // If no existing review, insert the new review
        $stmt_insert = $conn->prepare("INSERT INTO reviews (user_id, movie_id, review) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("iis", $activeUserId, $movieId, $reviewText);
        if ($stmt_insert->execute() === TRUE) {
            $stmt_insert->close();
            $conn->close();
            header("Location: viewmovie.php?movieId=" . urlencode($movieId));
            exit();
        } else {
            echo "Error: " . $stmt_insert->error;
        }
    } else {
        echo "Error: User not found";
    }
    $conn->close();
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if movieId is set in the URL
    if (isset($_GET['movieId'])) {
        // Get movieId from the URL
        $movieId = $_GET['movieId'];
        // Check if review text is provided
        if (isset($_POST['review-text'])) {
            // Get review text from the form
            $reviewText = $_POST['review-text'];
            // Call function to save the review
            saveReview($movieId, $reviewText);
        } else {
            echo "Review text is required.";
        }
    } else {
        echo "Movie ID is required.";
    }
}