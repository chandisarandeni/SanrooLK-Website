<?php
session_start();

include '../config.php';
// Start the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

// Access session data
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];
$userId = $_SESSION['user_id'];

echo "Welcome, $userName! Your email is $userEmail. id is $userId";




// Select the 'Payment' collection
$paymentCollection = $database->Payment;

// Fetch payments for the logged-in customer
$payments = $paymentCollection->find(['customerID' => $userId]);

// Convert MongoDB cursor to an array for easier handling
$paymentsArray = iterator_to_array($payments);

// Select the necessary collections
$orderCollection = $database->Order;
$productCollection = $database->Product;
$inquiryCollection = $database->Inquiry;
$checkoutCollection = $database->Checkout;

// Array to hold the combined order, payment, product, and quantity data
$ordersWithPayment = [];

if ($paymentsArray) {
    // Fetch all inquiries for the logged-in customer
    $inquiries = $inquiryCollection->find(['customerID' => $userId]);
    $inquiryArray = iterator_to_array($inquiries);

    // Map inquiry data for easy lookup
    $inquiryMap = [];
foreach ($inquiryArray as $inquiry) {
    // Check if both 'productID' and 'quantity' exist in the inquiry
    if (isset($inquiry['productID']) && isset($inquiry['quantity'])) {
        $inquiryMap[$inquiry['productID']] = $inquiry['quantity'];
    } else {
        // Log or handle the error if 'productID' or 'quantity' is missing
         // This will show the full inquiry for debugging purposes
    }
}


    // Loop through each payment and fetch corresponding orders
    foreach ($paymentsArray as $payment) {
        $paymentId = $payment['paymentID'];
        $checkoutId = $payment['checkoutID']; // Fetch checkoutID

        // Debug: Print paymentID
        //echo "Payment ID: " . $paymentId . "<br>";

        // Fetch related orders from Order collection
        $orders = $orderCollection->find(['paymentID' => $paymentId]);
        $ordersArray = iterator_to_array($orders);

        if ($ordersArray) {
            //echo "Orders found for PaymentID: " . $paymentId . "<br>";
        } else {
           // echo "No orders found for PaymentID: " . $paymentId . "<br>";
        }

        // Fetch product IDs from the Checkout collection
        $checkoutData = $checkoutCollection->find(['checkoutID' => $checkoutId]);
        $checkoutArray = iterator_to_array($checkoutData);

        if ($checkoutArray) {
           // echo "Checkout data found for CheckoutID: " . $checkoutId . "<br>";
        } else {
           // echo "No checkout data found for CheckoutID: " . $checkoutId . "<br>";
        }

        // Extract product IDs from checkout data
        $productIds = [];
        foreach ($checkoutArray as $checkout) {
            if (isset($checkout['productID'])) {
                $productIds[] = $checkout['productID'];
            }
        }

        // Fetch product details using the retrieved product IDs
        $productsArray = [];
        if (!empty($productIds)) {
            $products = $productCollection->find(['productID' => ['$in' => $productIds]]);
            $productsArray = iterator_to_array($products);
        }

        if ($productsArray) {
            //echo "Products found for CheckoutID: " . $checkoutId . "<br>";
        } else {
           // echo "No products found for CheckoutID: " . $checkoutId . "<br>";
        }

        // Loop through each order and combine with payment, product, and quantity data
        foreach ($ordersArray as $order) {
            foreach ($productsArray as $product) {
                $productId = $product['productID'];

                // Fetch the quantity using customerID from Inquiry collection
                $quantity = isset($inquiryMap[$productId]) ? $inquiryMap[$productId] : 0; // Default to 0 if not found

                // Combine data
                $ordersWithPayment[] = [
                    'orderId' => $order['orderID'],
                    'checkoutId' => $checkoutId,
                    'customerId' => $payment['customerID'],
                    'orderDate' => $order['orderDate'],
                    'paymentAmount' => $payment['paymentAmount'],
                    'productId' => $product['productID'],
                    'productName' => $product['productName'],
                    'quantity' => $quantity
                ];

                // Debugging Output
               // echo "Order ID: " . $order['orderID'] . "<br>";
              //  echo "Payment Amount: " . $payment['paymentAmount'] . "<br>";
              //  echo "Product ID: " . $product['productID'] . "<br>";
              //  echo "Product Name: " . $product['productName'] . "<br>";
              //  echo "Quantity: " . $quantity . "<br><br>";
            }
        }
    }
}

echo "User ID: " . $userId . "<br>";

// Final check if data is available
if (empty($ordersWithPayment)) {
    echo "No payment, product, or quantity data found.";
} else {
    echo "Order, payment, product, and quantity data fetched successfully.";
}
?>











<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard_orders.php">
                    <i class='bx bxs-box'></i>
                    <span>Orders</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="dashboard_inquiry.php"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class='bx bx-task'></i>
                    <span>inquiry</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="dashboard_maintenance.php"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class='bx bxs-hard-hat'></i>
                    <span>Maintenance</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_user.php"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class='bx bxs-user' ></i>
                    <span>User</span>
                </a>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"><i class='bx bxs-down-arrow' style="color: white"></i></button>
            </div>
        

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class='bx bx-menu' ></i>
                    </button>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest'; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="Images/profile-pic.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


            <div class="container-fluid">



                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Orders</h1>
                
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold"  style="color: #4AAB3D;">Order Data Table</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Order Date</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Check if there are any orders to display
                                        if (!empty($ordersWithPayment)) {
                                            // Loop through each order
                                            foreach ($ordersWithPayment as $orderData) { ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($orderData['productId']); ?></td>
                                                    <td><?= htmlspecialchars($orderData['productName']); ?></td>
                                                    <td><?= htmlspecialchars($orderData['orderDate']); ?></td>
                                                    <td><?= htmlspecialchars($orderData['quantity']); ?></td>
                                                    <td>$<?= htmlspecialchars($orderData['paymentAmount']); ?></td>
                                                </tr>
                                            <?php }
                                        } else {
                                            echo "<tr><td colspan='5'>No orders found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            <!-- End of Topbar -->

            
        
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="jquery/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>