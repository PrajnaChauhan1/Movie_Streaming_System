<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup Form</title>
<link rel="STYLESHEET" href="css/LOGIN.CSS">
<link rel="stylesheet" href="css/signup.css">
</head>
<body>
  
<div class="form-container">
  <form action="postSignup.php" method="POST">
  <?php
    // Check if there's an error message to display
    if(isset($_GET['error'])) {
        echo '<p style="color: red; margin-left:15%">' . htmlspecialchars($_GET['error']) . '</p>';
    }
?>
    </p>
    <input type="text" id="full name" name="fullname" placeholder="Full Name" required><br>
    <input type="tel" id="phone" name="phone" placeholder="Phone Number" required><br>
    <input type="email" id="email" name="email" placeholder="Email Address" required><br>
    <input type="number" id="age" name="age" placeholder="Age" required><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br>
    
    <button type="submit">Sign Up</button><br>
  </form>
  <p>Already have an account? <a href="index.php">Login </a></p>
</div>
</body>
<script src="javascript/signup.js"></script>
</html>
