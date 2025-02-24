<?php
require 'vendor/autoload.php'; // MongoDB Composer package

// Include the database configuration (connect to MongoDB)
include 'config.php'; // Make sure to include the config file that sets up the connection

// Start the session
session_start(); // This starts the session and is needed to store session data

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Access the 'Customer' collection
    $customerCollection = $allCollections['Customer'];

    // Find the user in the 'Customer' collection by customerEmail
    $user = $customerCollection->findOne(['customerEmail' => $email]);

    // Check if user exists and password matches
    if ($user && $user['customerPassword'] === $password) {
        // Successful login
        // Store user data in session
        $_SESSION['user_id'] = (string)$user['_id']; // Store MongoDB _id or another unique identifier
        $_SESSION['user_email'] = $user['customerEmail']; // Store email in session
        $_SESSION['user_name'] = $user['customerName']; // Optionally, store user name or other info

        // Redirect to a dashboard or another page
        header("Location: customer dashboard/dashboard_orders.php"); // Redirect to dashboard or another page
        exit();
    } else {
        // Invalid credentials
        echo "Invalid email or password!";
    }
}
?>
