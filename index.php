<?php
include 'config.php';
session_start(); // Start the session

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="animation.css" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-white shadow-sm">
            <div class="container">
                <!-- Brand Logo -->
                <a class="navbar-brand" href="#">
                    <img src="images/logo.png" alt="Logo" />
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
        </nav>


            <div class="hero">
                <div class="container">
                    <h1 class="hero-text">SWITCH TO <br>SOLAR ENERGY.</h1>
                </div>
            </div>
        
            <div class="container features">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card features-card py-5 px-3">
                            <div class="icon py-5"><i class='bx bx-dollar'></i></div>
                            <h5 class="mt-3">Cost Savings</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card features-card py-5 px-3">
                            <div class="icon py-5"><i class='bx bxs-cog' ></i></div>
                            <h5 class="mt-3">Sustainable Energy Source</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card features-card py-5 px-3">
                            <div class="icon py-5"><i class='bx bx-sort-up'></i></div>
                            <h5 class="mt-3">Increase Property Value</h5>
                        </div>
                    </div>
                </div>
            </div>
            
        </header>
        <main>
            <section class="goals py-5">
                <div class="container">
                    <div class="row align-items-center gap-5">
                        <div class="col-md-6 position-relative goal-panel">
                            <img src="images/goals-panel1.jpeg" alt="Solar Panels" class="img-fluid rounded">
                            <div class="small-box">
                                <img src="images/goals-woman.png" alt="Worker" class="img-fluid rounded">
                            </div>
                            <div class="tiny-box">
                                <!--this should be completed-->
                            </div>
                        </div>
            
                        <!-- Text Content -->
                        <div class="col-md-6">
                            <h4 class="fw-bold">ABOUT OUR COMPANY</h4>
                            <h2 class="fw-bold">Empowering a Sustainable Future with Solar Energy</h2>
                            <p class="text-muted">
                            Solar energy is more than just a technology—it's our passion. At [Your Company Name], we are committed to making clean and renewable energy accessible to everyone. Our goal is to provide high-quality solar solutions that help homeowners, businesses, and industries reduce their carbon footprint while saving on energy costs.
                            </p>
            
                            <!-- Features -->
                            <div class="d-flex align-items-start mb-3">
                                <span class="me-3 text-success fs-4"><i class='bx bx-sun' ></i></span>
                                <div>
                                    <h5 class="fw-bold">Reliable Solar Solutions</h5>
                                    <p class="text-muted mb-0">We design and deliver cutting-edge solar technology to meet diverse energy needs.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <span class="me-3 text-success fs-4"><i class='bx bx-world' ></i></span>
                                <div>
                                    <h5 class="fw-bold">Preserve the Planet</h5>
                                    <p class="text-muted mb-0">Every solar panel installed contributes to a cleaner, greener planet.</p>
                                </div>
                            </div>
            
                            <!-- CTA Button -->
                            <button class="btn px-4">DISCOVER MORE</button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="product-services py-5">
                <div class="container">
                    <div class="row text-center">
                        <h4>Services We Are Offering</h4>
                        <h1>Premium Solar Solutions & Expert<br>Services You Can Trust</h1>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="card services-card border shadow-lg">
                                <img src="images/services-1.png" class="card-img-top services-card-images" alt="Solar Panel">
                                <div class="card-body text-center services-body">
                                    <h5 class="card-title">Solar Panel Solutions</h5>
                                    <p class="card-text">High-performance solar panels designed to maximize energy production and efficiency for residential, commercial, and industrial use.</p>
                                    <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="card services-card border shadow-lg">
                                <img src="images/service-2.png" class="card-img-top services-card-images" alt="Solar Panel">
                                <div class="card-body text-center services-body">
                                    <h5 class="card-title">Installation</h5>
                                    <p class="card-text">Expert solar panel installation services with a seamless and hassle-free process, ensuring maximum energy output and long-term reliability.</p>
                                    <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="card services-card border shadow-lg">
                                <img src="images/service-3.jpg" class="card-img-top services-card-images" alt="Solar Panel">
                                <div class="card-body text-center services-body">
                                    <h5 class="card-title">Energy Storage Solutions</h5>
                                    <p class="card-text">Advanced battery storage solutions to help you store excess solar energy for use during nighttime or power outages, ensuring energy independence.</p>
                                    <a href="#" class="btn btn-link text-decoration-none text-dark">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            </section>
            <section class="mission">
                <div class="container-fluid why-choose-us">
                    <div class="row">
                        <!-- Left Content -->
                        <div class="col-md-6 why-text">
                            <h4 class="text-success text-uppercase">Why Choose Us</h4>
                            <h2>Empowering a Sustainable Future with Reliable Solar Solutions</h2>
                            <p>We are committed to providing high-quality solar energy solutions that make renewable power accessible to everyone. With cutting-edge technology and expert services, we ensure that every installation delivers maximum efficiency and long-term benefits.</p>
                            <p><strong> <i class='bx bx-bulb'></i> We're doing the right thing solar business. The right way.</strong></p>
                            <ul class="why-list">
                                <li><i class='bx bxs-check-circle' ></i> Sustainable & Cost-Effective Solutions</li>
                                <li><i class='bx bxs-check-circle' ></i> Expert Installation & Support</li>
                                <li><i class='bx bxs-check-circle' ></i> Advanced Solar Technology</li>
                            </ul>
                        </div>
            
                        <!-- Right Image + Video Section -->
                        <div class="col-md-6 p-0 d-flex">
                            <div class="video-section col-4">
                                <div class="play-btn"><i class='bx bx-play-circle' ></i></div>
                                <h3 class="text-white mt-3">Professional <br> Power Sun <br> Solar <br> services you <br> can trust</h3>
                            </div>
                            <div class="image-container col-8">
                                <img src="images/4-Common-Solar-Mistakes-To-Avoid-When-Buying-Solar-Panels.webp" alt="Solar Business">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="planning">
                <div class="hero-content">
                    <h1>Planning for Energy Project</h1>
                    <a href="#" class="btn mt-5 py-2 px-4" style="background: #4AAB3D; color: #fff;">Discover More</a>
                </div>
            </section>

            <section class="project-section">
                <div class="container">
                    <div class="row">
                        <!-- Text Content -->
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <h4 class="text-success fw-bold">RECENTLY COMPLETED WORK</h4>
                            <h2 class="project-title">Improve & Enhance the Tech Projects</h2>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <p class="project-text">
                                There are many variations of passages available, but the majority 
                                have suffered alteration in some form, by humor or randomized words 
                                which don’t look even slightly believable.
                            </p>
                        </div>
                    </div>
            
                    <div class="row d-flex justify-content-center align-items-center mt-5">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <img src="images/project-1.jpg" alt="Project 1" class="img-fluid rounded project-images">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <img src="images/project-2.jpg" alt="Project 2" class="img-fluid rounded project-images">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <img src="images/project-3.jpg" alt="Project 3" class="img-fluid rounded project-images">
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <img src="images/project-4.jpg" alt="Project 4" class="img-fluid rounded project-images">
                        </div>
                    </div>
                </div>
            </section>
            

            <section class="testimonial-section">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Testimonial Text -->
                        <div class="col-md-6">
                            <h3 class="text-success fw-bold">OUR FEEDBACKS</h3>
                            <h2 class="fw-bold">What They’re Talking About Company</h2>
                            <span class="quote-icon"><i class='bx bxs-quote-right'></i></span>
                            <p>
                                This is due to their excellent service, competitive pricing, and 
                                customer support. It’s refreshing to get such a personal touch.
                                Duis aute lorem ipsum is simply free text available in the market.
                            </p>
                            <p class="fw-bold">Mike Hardson</p>
                            <p class="text-muted">Senior Designer</p>
                        </div>
            
                        <!-- Image Section -->
                        <div class="col-md-6 position-relative text-center testimonial-images">
                            <!-- Large Circle Image -->
                            <img src="images/testimonial-1.jpg" alt="Main Testimonial" class="large-image img-fluid">
            
                            <!-- Smaller Profile Images (Hidden on Medium Screens) -->
                            <img src="images/testimonial-2.png" alt="Person 1" class="small-image img-1 d-none d-md-block">
                            <img src="images/testimonial-3.jpg" alt="Person 2" class="small-image img-2 d-none d-md-block">
                            <img src="images/testimonial-4.jpg" alt="Person 3" class="small-image img-3 d-none d-md-block">
                        </div>
                    </div>
                </div>
            </section>
            <section class="certificates">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="stats-card">
                                <div class="stats-number" data-target="10">0</div>
                                <div class="stats-label">PROJECT COMPLETE</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card">
                                <div class="stats-number" data-target="90" >0</div>
                                <div class="stats-label">HAPPY CLIENTS</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card">
                                <div class="stats-number" data-target="5">0</div>
                                <div class="stats-label">AWWORD WINNING</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card">
                                <div class="stats-number" data-target="20">0</div>
                                <div class="stats-label">COMPANY TEAM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="expert">
                <div class="container team-section text-center">
                    <h6>OUR FEEDBACKS</h6>
                    <h2>EXPERTS READY TO SERVE</h2>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-4 col-md-12 col-sm-12 expert-data">
                            <div class="card team-card d-flex justify-content-center align-items-center">
                                <img src="images/expert-1.png" class="img-fluid expert-image" alt="Kevin Hardson">
                                <div class="team-info">
                                    <h5>KEVIN HARDSON</h5>
                                    <p>DESIGNER</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card team-card d-flex justify-content-center align-items-center">
                                <img src="images/expert-2.png" class="img-fluid expert-image" alt="Jessica Brown">
                                <div class="team-info">
                                    <h5>JESSICA BROWN</h5>
                                    <p>DEVELOPER</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card team-card d-flex justify-content-center align-items-center">
                                <img src="images/expert-3.png" class="img-fluid expert-image" alt="Michale Smith">
                                <div class="team-info">
                                    <h5>MICHALE SMITH</h5>
                                    <p>CO FOUNDER</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="logo">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                </div>
            </section>

            <section class="form-question">
                <div class="container my-3">
                    <div class="row">
                        <!-- Contact Form Section -->
                        <div class="col-md-6">
                            <div class="contact-form">
                                <h6 class="text-success">CONTACT US</h6>
                                <h3>Write Email</h3>
                                <form>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Your Name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email Address">
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control" placeholder="Phone Number">
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="3" placeholder="Write a Message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-green">SEND A MESSAGE</button>
                                </form>
                            </div>
                        </div>
                
                        <!-- FAQ Section -->
                        <div class="col-md-6">
                            <div class="faq-section py-5 px-3">
                                <h6 class="text-success">QUESTIONS & ANSWERS</h6>
                                <h3>See Frequently Asked Questions</h3>
                                <div class="accordion mt-3" id="faqAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                                Is my technology allowed on tech?
                                            </button>
                                        </h2>
                                        <div id="faq1" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                            Solar panels absorb sunlight and convert it into electricity using photovoltaic cells. This electricity can power your home or business, reducing your reliance on the grid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                                How to soft launch your business?
                                            </button>
                                        </h2>
                                        <div id="faq2" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Learn to launch your business in phases for optimal success.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                                How to turn visitors into contributors?
                                            </button>
                                        </h2>
                                        <div id="faq3" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Engage your audience with interactive content and community-building.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                                How can I find my solutions?
                                            </button>
                                        </h2>
                                        <div id="faq4" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                Identify challenges, research solutions, and take action.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </section>

            <section class="news-articles py-5">
                <div class="container my-5">
                    <div class="section-title">
                        <h5>FROM THE BLOG</h5>
                        <h1 class="fw-bold">News & Articles</h1>
                    </div>
                    
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-4">
                            <div class="card news-card" style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/news-1.jpg" class="card-img-top" alt="Solar Panel">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <p class="meta"><span>👤 by Admin</span> <span>📌 Technology</span></p>
                                    <h6 class="card-title my-5">Professional technology information & solutions are just like...</h6>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 2 -->
                        <div class="col-md-4">
                            <div class="card news-card" style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/news-2.jpg" class="card-img-top" alt="Engineer with Solar Panels">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <p class="meta"><span>👤 by Admin</span> <span>📌 Technology</span></p>
                                    <h6 class="card-title my-5">Professional technology information & solutions are just like...</h6>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Card 3 -->
                        <div class="col-md-4">
                            <div class="card news-card"  style="background: #F8F8F8;">
                                <div class="position-relative">
                                    <img src="images/news-3.jpg" class="card-img-top" alt="Worker with Solar Panels">
                                </div>
                                <div class="card-body news-body mt-2">
                                    <p class="meta"><span>👤 by Admin</span> <span>📌 Technology</span></p>
                                    <h6 class="card-title my-5">Professional technology information & solutions are just like...</h6>
                                    <a href="#" class="read-more mt-3">READ MORE →</a>
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
        <!-- Bootstrap JavaScript Libraries -->
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
        <script src="script.js"></script>
    </body>
</html>
