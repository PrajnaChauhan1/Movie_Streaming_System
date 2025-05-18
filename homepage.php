<?php
include 'session.php';

// Check if there is an active user
if (!isActiveUser()) {
    // If no active user, redirect to login page
    header("Location: index.php?error=Please Login");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Streaming Service</title>
    <link rel="stylesheet" href="css/homepageopt.css">
</head>
<body>
    <header>
        <div class="logo">NPFLIX</div>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to Movie Streaming Service</h1>
                <p>Watch your favorite movies and shows anytime, anywhere.</p>
            </div>
        </section>
        <form class="search-box" action="searchResult.php" method="post">
                <input type="text" id="movieName" name="name" placeholder="Search movie by name..." required>
                <button type="submit">Search</button>
        </form>
        <section class="categories">
            <h2>Explore Categories</h2>
            <div class="category-grid">
                <div class="category">
                    <a href="categories.php?category=bollywood">
                    <img src="image/bollyhood.jpg" alt="Bollywood">
                    <h3>Bollywood</h3>
                    </a>
                </div>
                <div class="category">
                <a href="categories.php?category=hollywood">
                    <img src="image/hollyhood.jpg" alt="Hollywood">
                    <h3>Hollywood</h3>
                    </a>
                </div>
                <div class="category">
                <a href="categories.php?category=Nepali">
                    <img src="image/nepali.jpg" alt="Korean Dramas">
                    <h3>Nepali</h3>
                    </a>
                </div>
                <div class="category">
                <a href="categories.php?category=documentry">
                    <img src="image/documentries.jpg" alt="Documentaries">
                    <h3>Documentaries</h3>
                    </a>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-links">
            <a href="aboutus.html">About Us</a>
        </div>
        <div class="social-icons">
            <a href="#"><img src="image/facebook-logo.png" alt="Facebook"></a>
            <a href="#"><img src="image/twitter-logo.png" alt="Twitter"></a>
            <a href="#"><img src="image/instagram-logo.png" alt="Instagram"></a>
        </div>
    </footer>
</body>
<script src="javascript/upload.js"></script>
</html>
