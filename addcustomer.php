<?php
// Include your configuration file
require_once 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $customerID = $_POST['customerID'];  // From form (auto-generated)
    $customerFullName = $_POST['customerFullName'];
    $customerNic = $_POST['customerNic'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];

    // Validate if passwords match
    if ($password !== $retypePassword) {
        echo "<script>alert('Passwords do not match.');</script>";
        exit;
    }

    // Get the 'Customer' collection
    $customerCollection = $allCollections['Customer'];

    // Create an array to insert into MongoDB
    $customerData = [
        'customerID' => $customerID,
        'customerName' => $customerFullName,
        'customerNIC' => $customerNic,
        'customerDoB' => $dob,
        'customerAddress' => $address,
        'customerContact' => $contact,
        'customerEmail' => $email,
        'customerPassword' => $password,  // Store the password as plain text
        'registrationDate' => date('Y-m-d')  // Set current date
    ];

    try {
        // Insert the data into the 'Customer' collection
        $insertResult = $customerCollection->insertOne($customerData);

        // Check if the insertion was successful
        if ($insertResult->getInsertedCount() > 0) {
            // Redirect to the login page
            header("Location: customerlogin.php");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "<script>alert('Failed to insert customer data. Please try again.');</script>";
        }
    } catch (Exception $e) {
        // Handle any MongoDB insertion errors
        echo "Error: " . $e->getMessage();
    }
}
?>
