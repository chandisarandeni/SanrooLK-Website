<?php
include 'config.php';
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate form data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Check if all required fields are filled
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($phone) && !empty($message)) {
        try {
            // Select the collection from the database
            $collection = $database->CustomerServiceContact;

            // Prepare the document to insert
            $document = [
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'phone' => $phone,
                'message' => $message,
                'contactStatus' => 'Pending' // Default value
            ];

            // Insert the document into the collection
            $result = $collection->insertOne($document);

            // Check if the document was successfully inserted
            if ($result->getInsertedCount() == 1) {
                
                echo '<script>
                alert("Message sent successfully!");
                window.location.href = "contact.php";
            </script>';


            } else {
                echo '<script>
                alert("Message sent Unsuccessfully!");
                window.location.href = "contact.php";
            </script>';
            }
        } catch (MongoDB\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo '<script>
        alert("All Feilds Are Required");
        window.location.href = "contact.php";
    </script>';
    }
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
        <link rel="stylesheet"
        href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="styles.css">
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
                    <div class="shop-text">Contact</div>
                </div>
        </header>
        <main>
            <section class="contact py-5" style="background: #f3f3f3;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <h4 style="color: #4AAB3D;">Feel Free To Write</h4>
                            <h1>Send Us An Email</h1>
                            <form method="POST" action="">
                                <div class="form-row d-flex flex-row gap-2 my-5">
                                    <div class="form-group col-6 col-md-6">
                                        <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter Your Name" required>
                                    </div>
                                    <div class="form-group col-6 col-md-6">
                                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter Email" required>
                                    </div>
                                </div>

                                <div class="form-row d-flex flex-row gap-2 my-5">
                                    <div class="form-group col-6 col-md-6">
                                        <input type="text" class="form-control" id="inputSubject" name="subject" placeholder="Enter Subject" required>
                                    </div>
                                    <div class="form-group col-6 col-md-6">
                                        <input type="tel" class="form-control" id="inputTel" name="phone" placeholder="Enter Phone" required>
                                    </div>
                                </div>

                                <div class="form-group my-5">
                                    <textarea class="form-control" id="inputMessage" name="message" rows="7" placeholder="Enter Message" required></textarea>
                                </div>

                                <div class="d-flex gap-3 my-5">
                                    <button type="submit" class="btn rounded-5 px-3 py-2" style="background-color: #000; color: white">Send Message</button>
                                    <button type="button" class="btn rounded-5 px-4 py-2" onclick="resetForm()" style="background-color: #EF5C72; color: white">Reset</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                            <div class="row">
                                <h3 id="contact-text" style="color: #4AAB3D;">Need any help</h3>
                                <h1 id="contact-text">Get In Touch With Us</h1>
                                <p id="contact-text">Have questions or need assistance? Our team is here to help!<br>Whether you’re looking for support, have an inquiry, or just want to say hello, feel free to reach out.<br>We value your feedback and strive to provide the best service possible.<br> Get in touch today, and let’s start the conversation!</p>
                                
                                <!-- Contact Row 1 -->
                                <div class="row d-flex align-items-center flex-nowrap gap-3 py-4 p-4">
                                    <div class="box d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; background: #4AAB3D;"><i class='bx bxs-phone-call' style="color: white; font-size: 30px;"></i></div>
                                    <div class="contact-text">
                                        <h4>Have Any Questions</h4>
                                        <p>Free +94701234567</p>
                                    </div>
                                </div>
                        
                                <!-- Contact Row 2 -->
                                <div class="row d-flex align-items-center flex-nowrap gap-3 py-4 p-4">
                                    <div class="box d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; background: #4AAB3D;"><i class='bx bxs-envelope' style="color: white; font-size: 30px;"></i></div>
                                    <div class="contact-text">
                                        <h4>Write Email</h4>
                                        <p>contact@sanroo.lk</p>
                                    </div>
                                </div>
                        
                                <!-- Contact Row 3 -->
                                <div class="row d-flex align-items-center flex-nowrap gap-3 py-4 p-4">
                                    <div class="box d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; background: #4AAB3D;"><i class='bx bx-current-location' style="color: white; font-size: 30px;"></i></div>
                                    <div class="contact-text">
                                        <h4>Visit Anytime</h4>
                                        <p>No. 634, Dikwela Road,<br>Siyabalape.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <section class="map">
                <div class="container-fluid">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3960.258303490962!2d80.02690117499702!3d6.978818593021976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwNTgnNDMuOCJOIDgwwrAwMSc0Ni4xIkU!5e0!3m2!1sen!2slk!4v1740802846679!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
            function resetForm() {
            document.querySelector("form").reset();
}
        </script>
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
    </body>
</html>
