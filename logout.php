<?php
// Include the session functions file
require_once 'session.php';

// Call the invalidateSession() function to invalidate the session
invalidateSession();

// Redirect to a different file (e.g., index.php)
header("Location: index.php");
exit();
