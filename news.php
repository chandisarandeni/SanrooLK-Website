<?php
include 'config.php';
session_start(); // Start the session

?>

<!doctype html>
<html lang="en">

<head>
    <title>News</title>
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

    <link rel="stylesheet" href="styles.css">

    
</head>

<body>
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand-lg bg-white shadow-sm">
            <div class="container">
                <!-- Brand Logo -->
                <a class="navbar-brand" href="">
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
                <div class="shop-text">News</div>
            </div>
        </div>
    </header>
    <main>
        <!-- News Grid Section -->
        <section class="news-articles py-5">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-4 col- mb-4">
                            <div class="card news-card" style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/newso-1.jpg" class="card-img-top" alt="Solar Panel">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <h6 class="card-title my-5">Government Increases Solar Incentives for Homeowners</h6>
                                    <p>Exciting news! New government rebates and tax incentives make solar energy more affordable than ever. See how you can benefit today.</p>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 2 -->
                        <div class="col-md-4 mb-4">
                            <div class="card news-card" style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/newso-2.jpg" class="card-img-top" alt="Engineer with Solar Panels">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <h6 class="card-title my-5">Sanroo Pvt Ltd Introduces High-Efficiency Solar Panels</h6>
                                    <p>We’re proud to launch our latest range of high-efficiency solar panels designed to maximize energy output and savings. Explore the new technology now!</p>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 3 -->
                        <div class="col-md-4 mb-4">
                            <div class="card news-card"  style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/newso-3.jpg" class="card-img-top" alt="Worker with Solar Panels">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <h6 class="card-title my-5">Solar Battery Storage – The Future of Energy Independence</h6>
                                    <p>Recent updates to net metering regulations could impact your solar energy savings. Learn how these changes affect you.</p>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card 1 -->
                        <div class="col-md-4 mb-4">
                            <div class="card news-card" style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/newso-4.jpg" class="card-img-top" alt="Solar Panel">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <h6 class="card-title my-5">Sanroo Pvt Ltd Expands Service Coverage</h6>
                                    <p>With the rise of solar battery storage solutions, homeowners can now store excess energy and reduce dependence on the grid. Find out more about the latest innovations.</p>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 2 -->
                        <div class="col-md-4 mb-4">
                            <div class="card news-card" style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/newso-5.jpg" class="card-img-top" alt="Engineer with Solar Panels">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <h6 class="card-title my-5">Tips to Keep Your Solar Panels in Top Shape</h6>
                                    <p>Great news! We’re now offering solar installation and maintenance services in new locations. Check if your area is covered.</p>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 3 -->
                        <div class="col-md-4 mb-4">
                            <div class="card news-card"  style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/newso-6.jpg" class="card-img-top" alt="Worker with Solar Panels">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <h6 class="card-title my-5">The Rising Demand for Solar Energy in 2025</h6>
                                    <p>As energy costs continue to rise, more homeowners and businesses are turning to solar power for a sustainable and cost-effective solution. Discover why solar energy is the future.</p>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
                </div>
        </section>

        <section class="ready-service d-flex justify-content-center align-items-center">
            <div class="container-fluid service-section">
                <div class="service-box w-100" style="background: #4AAB3D;">
                    <div class="row">
                        <div class="col-md-4 col-sm-12"><img src="images/our-services.png" class="img-fluid" alt=""></div>
                        <div class="col-md-4 col-sm-12 d-flex justify-content-center align-items-center py-4"><h2>We’re Ready <br>
                            To Provide Our <br> Service To You</h2></div>
                        <div class="col-md-4 col-sm-12 d-flex align-items-center justify-content-center py-3"><button type="button" class="btn">our services</button></div>
                    </div>
                </div>
            </div>
        </section>
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
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>