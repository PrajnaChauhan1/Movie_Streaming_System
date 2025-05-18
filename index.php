<!DOCTYPE html>
<HEAD>
    <title>MOVIE STREAMING SYSTEM</title>
    <link rel="STYLESHEET" href="css/LOGIN.CSS">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</HEAD>

<BODY>
    <?php include 'create_database.php'; ?>
    <div class="LoginBox">
        <form action="postlogin.php" method="post">
            <h1>Login
            </h1>
            <?php
            if(isset($_GET['error'])) {
            echo '<p style="color: red; margin-left:15%">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            ?>
            <?php
            // Check if there's an error message to display
            if (isset($_GET['success'])) {
                echo '<p style="color: green; margin-left:15%">' . htmlspecialchars($_GET['success']) . '</p>';
            }
            ?>
            <div class="inputbox">
                <input type="email" placeholder=" Email" name="email" required>
                <i class='bx bxs-user-check'></i>
            </div>
            <div class="inputbox">
                <input type="password" name="password" placeholder="Enter Your Password" required>
                <i class='bx bxs-lock'></i>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Sign Up </a></p>
            </div>
    </div>
    </form>
</BODY>