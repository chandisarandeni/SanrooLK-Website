<?php
require_once 'config.php'; // Include the existing config file

// Ensure $database and $allCollections are available from config.php
if (!isset($database) || !isset($allCollections)) {
    die("Error: Database connection failed.");
}

// Select the 'Customer' collection
$customerCollection = $allCollections['Customer'] ?? null;

if (!$customerCollection) {
    die("Error: 'Customer' collection not found.");
}

// Function to generate the next Customer ID
function generateNextCustomerId($collection) {
    $lastCustomer = $collection->findOne([], ['sort' => ['customerID' => -1]]);
    if ($lastCustomer && isset($lastCustomer['customerID'])) {
        preg_match('/\d+/', $lastCustomer['customerID'], $matches);
        $nextNumber = str_pad($matches[0] + 1, 4, '0', STR_PAD_LEFT);
        return "CUSTM" . $nextNumber;
    }
    return "CUSTM0001"; // Default if no customers exist
}

// Get the next Customer ID
$nextCustomerID = generateNextCustomerId($customerCollection);
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Register</title>
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
        <link rel="stylesheet" href="animation.css">
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
        <section class=" bg-dark registration">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <!-- Left Side Image -->
                        <div class="col-xl-6 d-none d-xl-block">
                            <img src="images/register-background.jpg" alt="Sample photo" class="img-fluid w-100"
                                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem; object-fit: cover; height: 1175px;" />
                        </div>


                        <!-- Right Side Form -->
                        <div class="col-xl-6">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-5 text-uppercase">Customer Registration Form</h3>

                                <form action="addcustomer.php" method="POST" id="registrationForm">
                                    <!-- Customer ID -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="customerID">Customer ID</label>
                                        <input type="text" id="customerID" name="customerID" class="form-control form-control-lg" value="<?= $nextCustomerID ?>" readonly />
                                    </div>

                                    <!-- Full Name -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="customerFullName">Full Name</label>
                                        <input type="text" id="customerFullName" name="customerFullName" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Full Name -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="customerFullName">ID Number</label>
                                        <input type="text" id="customerNic" name="customerNic" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="dob">Date of Birth</label>
                                        <input type="date" id="dob" name="dob" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Address -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Contact Number -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="contact">Contact Number</label>
                                        <input type="text" id="contact" name="contact" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Email -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email ID</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Password -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Retype Password -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="retypePassword">Retype Password</label>
                                        <input type="password" id="retypePassword" name="retypePassword" class="form-control form-control-lg" required />
                                    </div>

                                    <!-- Buttons -->
                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="reset" class="btn btn-light btn-lg">Reset all</button>
                                        <button type="submit" class="btn btn-warning btn-lg ms-2">Submit form</button>
                                    </div>
                                </form>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Right Column -->
                    </div> <!-- End Row -->
                </div> <!-- End Card -->
            </div>
        </div>
    </div>
</section>

            
        </main>
        <footer>
            <!-- place footer here -->
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
