<?php
require '../config.php'; // Include the config file

session_start();
// Assuming customer_id is passed via GET or SESSION
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];
$userId = $_SESSION['user_id'];

//echo "Welcome, $userName! Your email is $userEmail. id is $userId";

 
 

try {
    // Select the Maintenance collection
    $collection = $allCollections['Maintenance']; // Fetching from the associative array in config.php

    // Query for maintenance records matching the customer_id
    $maintenanceRecords = $collection->find(['customerID' => $userId]);

    $ongoingCount = $collection->countDocuments([
        'customerID' => $userId,
        'maintenenceStatus' => 'Ongoing'
    ]);

    $finishedCount = $collection->countDocuments([
        'customerID' => $userId,
        'maintenenceStatus' => 'Completed'
    ]);

    $queuedCount = $collection->countDocuments([
        'customerID' => $userId,
        'maintenenceStatus' => 'Queued'
    ]);

    // Find the most recent maintenance record based on the last inserted ID
 $latestMaintenance = $collection->findOne([], ['sort' => ['maintenanceID' => -1]]);


 // Check if we have a valid last maintenance ID
 if ($latestMaintenance) {
     $lastMaintenanceId = $latestMaintenance['maintenanceID'];
     $newId = 'MT' . str_pad((int)substr($lastMaintenanceId, 2) + 1, 4, '0', STR_PAD_LEFT); // Increment the numeric part
 } else {
     // If no previous records, start with MT0001
     $newId = 'MT0001';
 }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch the maintenance description from the form input
    $maintenanceDesc = $_POST['maintenanceDesc'];

    // Assuming you already have the newId logic and it's working
    $newMaintenanceId = $newId; // Use your existing method to set the new ID

    // Prepare the data to be inserted into the Maintenance collection
    $maintenanceData = [
        'maintenanceID' => $newMaintenanceId,
        'maintenenceDescription' => $maintenanceDesc,
        'maintenenceStatus' => 'Queued', // Default status for new maintenances
        'scheduledDate' => null,
        'completedDate' => null,
        'maintenenceUpgrades' => null,
        'maintenenceCost' => null,
        'technicianID' => null,
        'maintenanceOfficerID' => null,
        'customerID' => $userId // Replace with dynamic customerID if needed
    ];

    // Insert the data into the MongoDB collection
    try {
        $collection = $allCollections['Maintenance']; // Fetch the collection
        $result = $collection->insertOne($maintenanceData);

        // Display the success message and redirect to the maintenance dashboard
        echo "<script>
                alert('Maintenance Added Successfully! ID: " . $newMaintenanceId . "');
                window.location.href = 'http://localhost/project/finalproject/SanrooLK-Website/customer%20dashboard/dashboard_inquiry.php';
              </script>";
    } catch (Exception $e) {
        echo "Error adding maintenance: " . $e->getMessage();
    }
}


    

} catch (Exception $e) {
    die("Error fetching data: " . $e->getMessage());
}
 
//echo "$newId";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Maintenance</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/new.css">
    <link rel="stylesheet" href="css/sb-admin-2.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    <img src="images/dashboard_logo.png" alt="" width="150" height="50">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
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
                <a class="nav-link collapsed" href="dashboard_maintenance.php"
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
            <li class="nav-item active">
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
                        <i class="fa fa-bars"></i>
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
                                <a class="dropdown-item"  data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
            <!-- DataTales Example -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Maintenance</h1>


    <div class="container py-5">
        <div class="row justify-content-center g-5">
            <div class="col-md-3">
            <div class="status-card mt-3">
                <div class="status-icon"><span class="material-symbols-outlined">
                    handyman
                </span></div>
                <h5 class="mt-2">Ongoing Maintenances</h5>
                <div class="status-count"><?php echo $ongoingCount; ?></div>
            </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="status-card">
                    <div class="status-icon"><span class="material-symbols-outlined">
                        check_small
                    </span></div>
                    <h5 class="mt-2">Finished Maintenances</h5>
                    <div class="status-count"><?php echo $finishedCount; ?></div>
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="status-card">
                    <div class="status-icon"><span class="material-symbols-outlined">
                        hourglass_bottom
                    </span></div>
                    <h5 class="mt-2">Queued Maintenances</h5>
                    <div class="status-count"><?php echo $queuedCount; ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-plus"></i> Add New
        </button>
    </div>

    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: #4AAB3D">Maintenance Data Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Maintenance ID</th>
                        <th>Description</th>
                        <th>Scheduled Date</th>
                        <th>Completed Date</th>
                        <th>Status</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($maintenanceRecords as $record): ?>
                        <tr>
                            <td><?php echo $record['maintenanceID'] ?? 'N/A'; ?></td>
                            <td><?php echo $record['maintenenceDescription'] ?? 'N/A'; ?></td>
                            <td><?php echo $record['scheduledDate'] ?? 'N/A'; ?></td>
                            <td><?php echo $record['completedDate'] ?? 'Pending'; ?></td>
                            <td><?php echo $record['maintenenceStatus'] ?? 'N/A'; ?></td>
                            <td><?php echo isset($record['maintenenceCost']) ? '$' . number_format($record['maintenenceCost'], 2) : 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
<!-- Add New Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Maintenance Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="maintenanceId">Maintenance ID</label>
                        <input type="text" class="form-control" id="maintenanceId" value="<?php echo $newId; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="maintenanceDesc">Maintenance Description</label>
                        <input type="text" class="form-control" id="maintenanceDesc" name="maintenanceDesc" placeholder="Enter Maintenance Description">
                    </div>
                    <!-- The Add button should be inside the form -->
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-5">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; by SanrooLK</span>
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
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

</body>

</html>