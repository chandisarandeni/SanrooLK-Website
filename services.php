<?php
include 'config.php';
session_start(); // Start the session

?>

<!doctype html>
<html lang="en">

<head>
    <title>Services</title>
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

        <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

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
                <div class="shop-text">Services</div>
            </div>
        </div>
    </header>
    <main>
        <section class="services">
            <div class="container mt-5">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-4">
                        <div class="card services-card">
                            <img src="images/services-1.png" class="card-img-top service-card-image" alt="Solar Panel">
                            <div class="card-body text-center">
                                <h5 class="card-title">Solar Panel Solutions</h5>
                                <p class="card-text">We've designed a culture that allows our team to assimilate.</p>
                                <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-4">
                        <div class="card services-card">
                            <img src="images/solar-and-wind-mill.png" class="card-img-top service-card-image" alt="Solar Panel">
                            <div class="card-body text-center">
                                <h5 class="card-title">Solar Panel Solutions</h5>
                                <p class="card-text">We've designed a culture that allows our team to assimilate.</p>
                                <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-4">
                        <div class="card services-card">
                            <img src="images/service-3-Cky2oWTe.jpg" class="card-img-top service-card-image" alt="Solar Panel">
                            <div class="card-body text-center">
                                <h5 class="card-title">Solar Panel Solutions</h5>
                                <p class="card-text">We've designed a culture that allows our team to assimilate.</p>
                                <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="services">
            <div class="container mt-5">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-4">
                        <div class="card services-card">
                            <img src="images/services-1.png" class="card-img-top service-card-image" alt="Solar Panel">
                            <div class="card-body text-center">
                                <h5 class="card-title">Solar Panel Solutions</h5>
                                <p class="card-text">We've designed a culture that allows our team to assimilate.</p>
                                <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-4">
                        <div class="card services-card">
                            <img src="images/solar-and-wind-mill.png" class="card-img-top service-card-image" alt="Solar Panel">
                            <div class="card-body text-center">
                                <h5 class="card-title">Solar Panel Solutions</h5>
                                <p class="card-text">We've designed a culture that allows our team to assimilate.</p>
                                <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-4 services-card">
                        <div class="card">
                            <img src="images/service-3-Cky2oWTe.jpg" class="card-img-top service-card-image" alt="Solar Panel">
                            <div class="card-body text-center">
                                <h5 class="card-title">Solar Panel Solutions</h5>
                                <p class="card-text">We've designed a culture that allows our team to assimilate.</p>
                                <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="services type py-5">
            <div class="container">
                <div class="row">
                    <!-- Sidebar / Navigation Section -->
                    <div class="col-md-3">
                        <div class="menu bg-light p-3 rounded">
                            <a href="#" class="d-block py-2 text-decoration-none text-dark">Wind Turbines</a>
                            <a href="#" class="d-block py-2 text-success fw-bold text-decoration-none text-dark>Wind Generators</a>
                            <a href="#" class="d-block py-2 text-decoration-none text-dark">Clean Energy</a>
                            <a href="#" class="d-block py-2 text-decoration-none text-dark">Renewable Energy</a>
                            <a href="#" class="d-block py-2 text-white bg-dark p-2 rounded text-decoration-none text-dark">Green Resources</a>
                            <a href="#" class="d-block py-2 text-decoration-none text-dark">Green Energy</a>
                        </div>
                    </div>
        
                    <!-- Image Section -->
                    <div class="col-md-9">
                        <img src="images/service-details-CzHi8Fu9.jpg" alt="Outdoor Installation" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </section>

        <!-- Service Overview Section -->
        <section class="service-overview">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="container d-flex justify-content-start align-items-center vh-50">
                            <div class="contact-card">
                                <i class='bx bxs-phone-call' ></i>
                                <h5>Contact Us</h5>
                                <h5>+945263157</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h2 class="mb-4">Services Overview</h2>
                        <p>At Sanroo, we offer a comprehensive range of solar energy solutions designed to meet the diverse needs of homeowners, businesses, and industries. From professional solar panel installation and customized system design to maintenance, repairs, and energy storage solutions, we ensure a seamless transition to renewable energy. Our expert team also assists with grid connections, net metering, and government incentives, making solar power more accessible and cost-effective. Whether you're looking to install a new system, upgrade an existing one, or purchase high-quality solar products, we provide reliable, efficient, and sustainable energy solutions tailored to your requirements.</p>
                        <h2 class="mb-4">Service Center</h2>
                        <p>Our Service Center is dedicated to providing top-notch support and maintenance for all your solar energy needs. Whether you need routine inspections, troubleshooting, repairs, or upgrades, our skilled technicians ensure that your solar system operates at peak efficiency. We offer fast and reliable assistance for solar panels, inverters, batteries, and other components, helping you maximize energy savings and system longevity. With a commitment to quality service and customer satisfaction, our team is always ready to address your concerns and keep your solar investment running smoothly.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Service Center Section -->
        <section class="service-center">
            <div class="container">
                
                <div class="row">
                    <div class="col-md-6">
                        <img src="images\service-d2-GZjKabx2.jpg" alt="Indoor Planning">
                        <p>Exploring modern sustainability with eco-friendly innovations, combining nature and technology to create a cleaner, greener future for everyone.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="images\service-d1-2n1zqO50.jpg" alt="Outdoor Installation">
                        <p>Professionals collaborating on clean energy solutions, leveraging technology and expertise to drive sustainable progress and a better tomorrow for all.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section p-4">
            <div class="container mt-3">
                <h2 class="mb-4">Frequently Asked Questions</h2>
                <p class="mb-5">If you have any additional questions that aren't covered here, feel free to contact our support team. We're always happy to help and ensure you have the best experience with our services!</p>

                <div class="accordion" id="faqAccordion">
                    <!-- Question 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Question 1
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                What maintenance is required for solar panels?
                            </div>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Question 2
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                How long do solar panels last?
                            </div>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Question 3
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                What are the benefits of installing solar panels?
                            </div>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Question 4
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                How do solar panels work?
                            </div>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>