<?php
// Start the session
session_start();

// Include your configuration file
include '../config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $customerID = $_SESSION['user_id'];  // Customer ID passed from session or form
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $retypeNewPassword = $_POST['retypeNewPassword'];

    // Get the 'Customer' collection
    $customerCollection = $allCollections['Customer'];

    try {
        // Debugging: Check if the customerID is being passed correctly
        error_log('Customer ID: ' . $customerID); // Log customerID to check it

        // Fetch the customer record based on customerID
        $customer = $customerCollection->findOne(['customerID' => $customerID]);

        // Debugging: Log the fetched customer data
        error_log('Fetched Customer: ' . print_r($customer, true)); // Log the customer object

        // Check if customer exists
        if ($customer) {
            // Verify if the old password is correct
            if ($oldPassword === $customer['customerPassword']) {
                
                // Check if the new password and retype new password match
                if ($newPassword === $retypeNewPassword) {
                    // Prepare the updated customer data (without hashing the new password)
                    $updatedCustomerData = [
                        'customerPassword' => $newPassword,  // Store the new password directly
                    ];

                    // Update the customer's password
                    $updateResult = $customerCollection->updateOne(
                        ['customerID' => $customerID],  // Find customer by customerID
                        ['$set' => $updatedCustomerData]  // Set the updated password
                    );

                    // Check if the update was successful
                    if ($updateResult->getModifiedCount() > 0) {
                        // Success message in JavaScript
                        echo "<script>alert('Password updated successfully.'); window.location.href='dashboard_user.php';</script>";
                    } else {
                        // Failure message in JavaScript
                        echo "<script>alert('Failed to update password. Please try again.'); window.location.href='dashboard_user.php';</script>";
                    }
                } else {
                    // New password mismatch message in JavaScript
                    echo "<script>alert('New passwords do not match.'); window.location.href='dashboard_user.php';</script>";
                }
            } else {
                // Incorrect old password message in JavaScript
                echo "<script>alert('Old password is incorrect.'); window.location.href='dashboard_user.php';</script>";
            }
        } else {
            // Customer not found message in JavaScript
            $_SESSION['update_error'] = "Customer not found.";
        }
    } catch (Exception $e) {
        // Handle any MongoDB errors
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='dashboard_user.php';</script>";
    }
}
?>
