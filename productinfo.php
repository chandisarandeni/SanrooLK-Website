<?php
require 'config.php'; // Include database connection file

session_start();

$userId = $_SESSION['user_id'];

// Get productID from URL
if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];

    // Fetch product details from the database
    $productCollection = $database->Product;
    $product = $productCollection->findOne(['productID' => $productID]);

    // Fetch images if stored separately
    $imageCollection = $database->Images; // Change if images are stored in a different collection
    $productImages = $imageCollection->find(['productID' => $productID]);

    if (!$product) {
        die("Product not found!");
    }
} else {
    die("Invalid request!");
}

$inquiryCollection = $database->Inquiry;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productID = $_POST['productID'];
    $customerID = $_POST['customerID'];
    $inquiryDescription = trim($_POST['inquiryDescription']);
    $inquiryDate = date("c"); // Current ISO 8601 date
    $salesManagerID = "SMGR0001"; // Default or dynamically set

    if (empty($inquiryDescription)) {
        header("Location: product_page.php?error=Description is required");
        exit;
    }

    // Generate auto-incremented inquiryID
    $lastInquiry = $inquiryCollection->findOne([], ['sort' => ['inquiryID' => -1]]);
    $lastID = $lastInquiry ? intval(substr($lastInquiry['inquiryID'], 3)) : 0;
    $newInquiryID = "INQ" . str_pad($lastID + 1, 4, "0", STR_PAD_LEFT);

    $insertData = [
        "inquiryID" => $newInquiryID,
        "inquiryDescription" => $inquiryDescription,
        "inquiryDate" => $inquiryDate,
        "inquiryStatus" => "Pending",
        "customerID" => $customerID,
        "productID" => $productID,
        "salesManagerID" => $salesManagerID
    ];

    $result = $inquiryCollection->insertOne($insertData);

    if ($result->getInsertedCount() > 0) {
        echo "<script>
            alert('Inquiry sent successfully!');
            window.location.href = 'http://localhost/project/finalproject/SanrooLK-Website/customer%20dashboard/dashboard_inquiry.php';
        </script>";
    } else {
        echo "<script>
            alert('Failed to send inquiry. Please try again.');
            window.location.href='product_page.php';
        </script>";
    }
    exit;
    
}

$relatedProducts = $database->Product->find([], ['limit' => 4]);
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="styles.css">
        
        <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-white shadow-sm">
                <div class="container">
                    <!-- Brand Logo -->
                    <a class="navbar-brand" href="#">
                        <img src="images/logo.png" alt="Logo">
                    </a>
            
                    <!-- Navbar Toggle Button for Mobile -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <!-- Navbar Links -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                        <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>

                    <!-- Conditionally show Login or Profile based on session -->
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <!-- Profile Dropdown -->
                        <div class="dropdown">
                            <img src="images/profile-pic.jpg" class="profile-pic dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" alt="Profile" />
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="customer dashboard/dashboard_orders.php">Orders</a></li>
                                <li><a class="dropdown-item" href="customer dashboard/dashboard_inquiry.php">Inquiry</a></li>
                                <li><a class="dropdown-item" href="customer dashboard/dashboard_maintenance.html">Maintenance</a></li>
                                <li><a class="dropdown-item" href="customer dashboard/dashboard_user.php">User</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Login Button -->
                        <a href="customerlogin.php" class="btn btn-success me-3">Login</a>
                    <?php endif; ?>
                </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container mt-5">
            <div class="row">
                    <div class="col-md-6">
                        <!-- Main Product Image -->
                        <img src="<?= htmlspecialchars($product['imageUrl']); ?>" class="img-fluid" alt="Product Image">
                        
                        <!-- Thumbnails -->
                        <div class="d-flex mt-2">
                            <img src="<?= htmlspecialchars($product['imageUrl']); ?>" class="img-thumbnail me-2" width="80">
                            <img src="<?= htmlspecialchars($product['imageUrl']); ?>" class="img-thumbnail me-2" width="80">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                    <form action="" method="post">
                        <h2><?= htmlspecialchars($product['productName']); ?> 
                            <span class="text-success">$<?= htmlspecialchars($product['productPrice']); ?></span>
                        </h2>
                        <p>★★★★★ <small>2 Customer Reviews</small></p>
                        <p><?= htmlspecialchars($product['productDescription']); ?></p>
                        <p><strong>REF:</strong> <?= htmlspecialchars($product['productSKU']); ?></p>
                        <p><strong>Available Quantity:</strong> <?= htmlspecialchars($product['productQuantity']); ?></p>

                        <input type="hidden" name="productID" value="<?= htmlspecialchars($product['productID']); ?>">
                        <input type="hidden" name="customerID" value="<?= htmlspecialchars($_SESSION['user_id'] ?? 'CUST0001'); ?>"> 

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Choose quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control w-25" value="1">
                        </div>

                        <div class="mb-3">
                            <label for="inquiry-description" class="form-label">Add a Description</label>
                            <textarea id="inquiry-description" name="inquiryDescription" class="form-control" rows="3" placeholder="Enter your message..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">SEND INQUIRY</button>
                    </form>


                </div>

                <div class="mt-5 container">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" id="desc-tab" data-bs-toggle="tab" href="#description">DESCRIPTION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews">REVIEWS</a>
                        </li>
                    </ul>
                    <div class="tab-content p-3 border" class="text-decoration-none">
                        <div class="tab-pane fade show active" id="description">
                            <h4>Description</h4>
                            <p><?= htmlspecialchars($product['productDescription']); ?></p>
                        </div>
                        <div class="tab-pane fade" id="reviews">
                            <h4>Reviews</h4>
                            <p>No reviews yet. Be the first to review this product!</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>Related Products</h4>
                    <div class="row">
                            <?php foreach ($relatedProducts as $product): ?>
                                <div class="col-md-3 mb-4 related-products">
                                    <div class="card h-100 product-realated-card">
                                        <a href="productinfo.php?productID=<?= urlencode($product['productID']); ?>" class="text-decoration-none">
                                            <img src="<?= htmlspecialchars($product['imageUrl']) ?>" class="card-img-top img-fluid related-product-img" alt="<?= htmlspecialchars($product['productName']) ?>">
                                            <div class="card-body product-related-card-body">
                                                <h5 class="card-title related-card-title"><?= htmlspecialchars($product['productName']) ?></h5>
                                                <p class="card-text related-card-text">⭐️⭐️⭐️⭐️⭐️</p>
                                                <p class="card-text related-card-text"><strong>$<?= htmlspecialchars($product['productPrice']) ?></strong></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <style>
    /* Style for the related products row */

/* Style for each related product card */
.related-products {
    flex: 1 1 22%; /* Makes sure each card takes up approximately 22% of the width, adjusts based on screen size */
    box-sizing: border-box;
}

/* Style for the product card container */
.product-realated-card {
    border: 1px solid #ddd; /* Adds a border around the card */
    border-radius: 8px; /* Rounds the corners */
    overflow: hidden; /* Ensures image doesn't overflow the card */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover effects */
}

/* Hover effect for the product card */
.product-realated-card:hover {
    transform: translateY(-5px); /* Slightly lift the card */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* More pronounced shadow */
}

/* Style for the product image */
.related-product-img {
    width: 100%;
    height: auto;
    object-fit: cover; /* Ensures the image covers the area without stretching */
}

/* Style for the card body */
.product-related-card-body {
    padding: 15px; /* Padding inside the card */
    background-color: #fff; /* Background color for the card body */
}

/* Style for the product title */
.product-related-card-body .related-card-title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 10px; /* Space between title and other content */
}

/* Style for the rating */
.product-related-card-body .related-card-text {
    font-size: 1rem;
    color: #f39c12; /* Gold color for the stars */
    margin-bottom: 10px; /* Space between rating and price */
}

/* Style for the product price */
.product-related-card-body .related-card-text strong {
    font-size: 1.2rem;
    color: #27ae60; /* Green color for the price */
}

</style>


                </div>
            </div>
        </main>
        <footer>
            <footer class="footer">
                <div class="container footer-content">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="images/SanrooLogo.png" alt="">
                            <p>Desires to obtain pain of itself, because it is pain, but occasionally circumstances.</p>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Explore</h5>
                            <ul class="list-unstyled">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="services.php">Services</a></li>
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="news.php">News</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h5>Contact</h5>
                            <p>No. 634, Dikwela Road, Siyabalape.</p>
                            <p><a href="mailto:sanrooprices@gmail.com">sanrooprices@gmail.com</a></p>
                            <p><a href="tel:+94701234567">+94 701234567</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
