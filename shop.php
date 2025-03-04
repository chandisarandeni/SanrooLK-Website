<?php
require 'config.php';

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

 ?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
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
                        <img src="images/profile-pic.jpg" class="profile-pic dropdown-toggle" id="profileDropdown"
                            data-bs-toggle="dropdown" alt="Profile">
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
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
                                <div class="categories d-flex flex-column">
                                    <a href="#" class="category-link text-decoration-none text-dark"> Cloud Solution</a>
                                    <a href="#" class="category-link text-decoration-none text-dark"> Cyber Data</a>
                                    <a href="#" class="category-link text-decoration-none text-dark"> SEO Marketing</a>
                                    <a href="#" class="category-link text-decoration-none text-dark"> UI/UX Design</a>
                                    <a href="#" class="category-link text-decoration-none text-dark"> Web Development</a>
                                    <a href="#" class="category-link text-decoration-none text-dark"> Artificial Intelligence</a>
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
                                    <a href="#" class="d-flex align-items-center text-decoration-none my-2">
                                        <div class="product-image"></div>
                                        <div>
                                            <p class="mb-0">Best Headset</p>
                                            <p class="mb-0 text-muted">$45.00</p>
                                        </div>
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-decoration-none my-2">
                                        <div class="product-image"></div>
                                        <div>
                                            <p class="mb-0">Wireless Mouse</p>
                                            <p class="mb-0 text-muted">$30.00</p>
                                        </div>
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-decoration-none my-2">
                                        <div class="product-image"></div>
                                        <div>
                                            <p class="mb-0">Smart Keyboard</p>
                                            <p class="mb-0 text-muted">$70.00</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Product Grid Section -->


                <div class="col-lg-9">
                    <div class="row">
                        <?php foreach ($products as $product): ?>
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