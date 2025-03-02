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
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                            <li class="nav-item"><a class="nav-link" href="shop.html">Shop</a></li>
                            <li class="nav-item"><a class="nav-link" href="news.html">News</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                        </ul>
            
                        <!-- Login Button -->
                        <a href="customerlogin.html" class="btn btn-success me-3">Login</a>
            
                        <!-- Profile Dropdown -->
                        <div class="dropdown">
                            <img src="images/profile-pic.jpg" class="profile-pic dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" alt="Profile">
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
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
                    <div class="tab-content p-3 border">
                        <div class="tab-pane fade show active" id="description">
                            <h4>Description</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <ul>
                                <li>Nam at elit nec neque suscipit gravida.</li>
                                <li>Aenean egestas orci ac maximus tincidunt.</li>
                                <li>Curabitur vel turpis et tellus cursus laoreet.</li>
                            </ul>
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
                        <div class="col-md-3">
                            <img src="image.png" class="img-fluid">
                            <p class="text-center">⭐️⭐️⭐️⭐️⭐️<br><strong>Headphone</strong> $32.00</p>
                        </div>
                        <div class="col-md-3">
                            <img src="image.png" class="img-fluid">
                            <p class="text-center">⭐️⭐️⭐️⭐️⭐️<br><strong>Lagage</strong> $32.00</p>
                        </div>
                        <div class="col-md-3">
                            <img src="image.png" class="img-fluid">
                            <p class="text-center">⭐️⭐️⭐️⭐️⭐️<br><strong>Watch</strong> $32.00</p>
                        </div>
                        <div class="col-md-3">
                            <img src="image.png" class="img-fluid">
                            <p class="text-center">⭐️⭐️⭐️⭐️⭐️<br><strong>SD Card</strong> $32.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <footer class="footer">
                <div class="container footer-content">
                    <div class="row">
                        <div class="col-md-4">
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
                                <li><a href="#">About Company</a></li>
                                <li><a href="#">Meet the Team</a></li>
                                <li><a href="#">News & Media</a></li>
                                <li><a href="#">Our Projects</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h5>Contact</h5>
                            <p>No. 634, Dikwela Road, Siyabalape.</p>
                            <p><a href="mailto:sanrooprices@gmail.com">sanrooprices@gmail.com</a></p>
                            <p><a href="tel:+94701234567">+94 701234567</a></p>
                        </div>
                        <div class="col-md-2">
                            <h5>Gallery</h5>
                            <div class="gallery d-flex flex-wrap">
                                <img src="image1.jpg" alt="Gallery Image">
                                <img src="image2.jpg" alt="Gallery Image">
                                <img src="image3.jpg" alt="Gallery Image">
                                <img src="image4.jpg" alt="Gallery Image">
                                <img src="image5.jpg" alt="Gallery Image">
                                <img src="image6.jpg" alt="Gallery Image">
                            </div>
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
