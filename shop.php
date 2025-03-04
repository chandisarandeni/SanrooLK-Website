<?php
require 'config.php';
session_start();

function getFilteredProducts($database, $minPrice = 10, $maxPrice = 5000) {
    try {
        $collection = $database->Product;
        return $collection->find([
            'productPrice' => ['$gte' => $minPrice, '$lte' => $maxPrice]
        ]);
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

// Get min and max price from GET request (default to 10 and 10000 if not set)
$minPrice = isset($_GET['minPrice']) ? (int)$_GET['minPrice'] : 10;
$maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : 5000;

// Fetch products using the function
$products = getFilteredProducts($database, $minPrice, $maxPrice);

// Fetch the first 4 products from the Product collection
$popularProducts = $database->Product->find([], [
    'limit' => 4  // Limit the number of products to 4
]);

// Convert the cursor to an array
$newProducts = iterator_to_array($popularProducts);


$categoriesCursor = $database->Product->aggregate([
    ['$group' => [
        '_id' => '$productCategory', // Group by category
        'count' => ['$sum' => 1] // Count the number of products in each category
    ]],
    ['$sort' => ['_id' => 1]] // Sort categories alphabetically
]);

// Convert cursor to an array
$categories = iterator_to_array($categoriesCursor);

$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

if ($selectedCategory) {
    // Fetch products that match the selected category
    $collection = $database->Product;
    $productsCursor = $collection->find(['productCategory' => $selectedCategory]);
    $products = iterator_to_array($productsCursor);
} else {
    // Fetch all products if no category is selected
    $collection = $database->Product;
    $productsCursor = $collection->find([], ['limit' => 10]); // Limit for performance
    $products = iterator_to_array($productsCursor);
}
 ?>
<!doctype html>
<html lang="en">

<head>
    <title>Shop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animation.css">
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
                                <li><a class="dropdown-item" href="customer dashboard/dashboard_maintenance.php">Maintenance</a></li>
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
            </div>
        </nav>
        <div class="container-fluid">
            <div class="shop-section">
                <div class="shop-text">SHOP</div>
            </div>
        </div>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row py-5">

                <!-- Sidebar Section -->
                <div class="col-lg-3 col-md-12">
                    <div class="sidebar">

                        <!-- Categories -->
                        <div class="card mb-3" style="background-color: #f8f8f8;">
                            <div class="card-body">
                                <h5 class="card-title">Categories</h5>
                                <div class="categories d-flex flex-column" style="color: #A9A9A9; font-weight: 500;">
                                    <?php foreach ($categories as $category): ?>
                                        <a href="products.php?category=<?= urlencode($category['_id']); ?>" 
                                        class="category-link text-decoration-none text-dark">
                                            <?= htmlspecialchars($category['_id']); ?> (<?= $category['count']; ?>)
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>


                        <!-- Filter by Price -->
                        <!-- Filter by Price -->
                            <div class="card mb-3" style="background-color: #f0f0f0;">
                                <div class="card-body">
                                    <h5 class="card-title">Filter by Price</h5>    

                                    <label for="priceRange" class="form-label">Select Price Range:</label>
                                    <input type="range" class="form-range mb-2" min="10" max="10000" value="10000" id="priceRange" step="1">
                                    
                                    <small>Price: $<span id="minPrice" aria-live="polite">10</span> - $<span id="maxPrice" aria-live="polite">10000</span></small>

                                    <div class="mt-2">
                                        <form action="" method="GET">
                                            <!-- Range Values -->
                                            <input type="hidden" name="minPrice" id="minPriceValue" value="10">
                                            <input type="hidden" name="maxPrice" id="maxPriceValue" value="10000">

                                            <!-- Apply and Reset Buttons -->
                                            <button class="btn btn-success btn-sm" type="submit">Apply</button>
                                            <button class="btn btn-outline-secondary btn-sm" type="reset" onclick="resetFilter()">Reset</button>
                                        </form>
                                    </div>
                                </div>
                            </div>





                        <!-- Popular Products -->
                        <div class="card" style="background-color: #f8f8f8;">
                            <div class="card-body">
                                <h5 class="card-title">Popular Products</h5>
                                <div class="popular-products">
                                    <?php foreach ($newProducts as $popProduct): ?>
                                        <a href="productinfo.php?productID=<?= urlencode($popProduct['productID']); ?>" class="d-flex align-items-center text-decoration-none my-2">
                                            <div class="product-image">
                                                <!-- Display the product image -->
                                                <img src="<?= htmlspecialchars($popProduct['imageUrl']); ?>" alt="<?= htmlspecialchars($product['productName']); ?>" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                                            </div>
                                            <div>
                                                <p class="mb-0"><?= htmlspecialchars($popProduct['productName']); ?></p>
                                                <p class="mb-0 text-muted">$<?= htmlspecialchars($popProduct['productPrice']); ?></p>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Product Grid Section -->


                <div class="col-lg-9">
    <div class="row">
        <?php 
        // Assuming $products is already filtered by the selected category
        foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <a href="productinfo.php?productID=<?= urlencode($product['productID']); ?>" class="text-decoration-none">
                    <div class="card product-card">
                        <img src="<?= htmlspecialchars($product['imageUrl']); ?>" class="card-img-top" alt="<?= htmlspecialchars($product['productName']); ?>">
                        <div class="card-body text-center">
                            <h6 class="card-title">
                                <?= htmlspecialchars($product['productName']); ?> 
                            </h6>
                            <p>Quantity <span class="text-muted">(<?= htmlspecialchars($product['productQuantity']); ?>)</span></p>
                            <p class="text-success">$<?= htmlspecialchars($product['productPrice']); ?></p>
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>




                <!-- End of Product Grid -->
                
            </div>
        </div>
        <div class="pagination d-flex justify-content-center align-items-center">
            <button class="btn btn-outline-primary btn-sm" id="prevPage">Previous</button>
            <span id="pageNumber">Page: 1</span>
            <button class="btn btn-outline-primary btn-sm" id="nextPage">Next</button>
        </div>
       
        
    </main>
    <footer>
        <!-- place footer here -->
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

    <script>
    const priceRange = document.getElementById("priceRange");
const minPrice = document.getElementById("minPrice");
const maxPrice = document.getElementById("maxPrice");
const applyButton = document.getElementById("applyButton");

// Update the price values based on the selected range (on slider input)
priceRange.addEventListener("input", function() {
    const minValue = priceRange.value;
    const maxValue = priceRange.max;

    minPrice.textContent = minValue;
    maxPrice.textContent = maxValue;
});

// Function to apply filter (triggered by the Apply button)
applyButton.addEventListener("click", function() {
    const minValue = priceRange.value;
    const maxValue = priceRange.max;

    // Update the displayed min and max prices on apply
    minPrice.textContent = minValue;
    maxPrice.textContent = maxValue;

    // Alert showing updated price range after Apply button click
    alert(`Updated Price Range: $${minValue} - $${maxValue}`);
});

// Reset filter to default values
function resetFilter() {
    priceRange.value = 10;
    priceRange.max = 5000;
    minPrice.textContent = 10;
    maxPrice.textContent = 5000;
}

</script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>