<?php
session_start(); // Start the session

// Destroy the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the homepage or login page after logout
header("Location: index.php"); // You can change this to your desired page
exit();
?>
