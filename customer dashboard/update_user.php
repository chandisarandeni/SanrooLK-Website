<?php

session_start();
// Include your configuration file
include '../config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $customerID = $_POST['customerID'];  // From form (auto-generated)
    $customerFullName = $_POST['customerFullName'];
    $customerContact = $_POST['customerContact'];
    $customerAddress = $_POST['customerAddress'];

    // Get the 'Customer' collection
    $customerCollection = $allCollections['Customer'];

    // Prepare the updated customer data (don't change the email)
    $updatedCustomerData = [
        'customerName' => $customerFullName,
        'customerContact' => $customerContact,
        'customerAddress' => $customerAddress,
        // Don't include 'customerEmail' if it's not changing
    ];

    try {
        // Update the customer document based on customerID
        $updateResult = $customerCollection->updateOne(
            ['customerID' => $customerID],  // Find customer by customerID
            ['$set' => $updatedCustomerData]  // Set the updated values
        );

        // Check if the update was successful
        if ($updateResult->getModifiedCount() > 0) {
            echo "<script>alert('Profile updated successfully.'); window.location.href='dashboard_user.php';</script>";
        } else {
            echo "<script>alert('Failed to update profile.');</script>";
        }
    } catch (Exception $e) {
        // Handle any MongoDB update errors
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>
