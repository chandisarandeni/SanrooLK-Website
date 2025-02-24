<?php
require 'vendor/autoload.php'; // Load MongoDB PHP library

// MongoDB connection configuration for MongoDB Atlas Cluster
$mongoDbUri = "mongodb+srv://WebClient:5PQKef7D7fFk88OS@sanroolk.xxwnk.mongodb.net/?retryWrites=true&w=majority&appName=SanrooLK";
$mongoDbName = "SanrooLKDB";  // Database name

try {
    // Create MongoDB client instance using the connection string
    $mongoClient = new MongoDB\Client($mongoDbUri);

    // Select the database
    $database = $mongoClient->$mongoDbName;

    // Get all available collections dynamically
    $collections = $database->listCollections();

    // Store collection objects in an associative array
    $allCollections = [];
    foreach ($collections as $collectionInfo) {
        $collectionName = $collectionInfo->getName();
        $allCollections[$collectionName] = $database->$collectionName; // Assign collection object
    }

    echo "MongoDB connection to Atlas cluster successful!";

} catch (MongoDB\Exception\AuthenticationException $e) {
    echo "Authentication Error: " . $e->getMessage();
} catch (MongoDB\Exception\ConnectionTimeoutException $e) {
    echo "Connection Timeout: " . $e->getMessage();
} catch (MongoDB\Exception\InvalidArgumentException $e) {
    echo "Invalid Argument: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>