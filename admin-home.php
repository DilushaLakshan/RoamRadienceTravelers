<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;

        // get the records according to the staff_member_id
        $staffResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `id`='" . $uID . "'");
        $staffNumRows = $staffResultSet->num_rows;
        if ($staffNumRows == 1) {
            $staffData = $staffResultSet->fetch_assoc();
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'back-header.php'; ?>
            <!-- scrollable area -->
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-3 mb-5">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h4 class="stf-sub-heading">Welcome back, <?php echo $staffData["first_name"]; ?></h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <!-- clickable cards -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="staff-registration.php">Add New User</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="all-staff-members.php">View Users</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="add-destination.php">Add New Destination</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="back-destinations.php">Manage Destinations</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="addVehicle.php">Add New Vehicle</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="manageVehicles.php">Manage Vehicles</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="add-hotel.php">Add New Hotel</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="manageHotels.php">Manage Hotels</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="add-tourpackage.php">Add New Tour Package</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <div class="card back-card">
                                    <div class="card-body">
                                        <center>
                                            <a class="back-link" href="stf-tPackages.php">Manage Tour Packages</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- clickable cards -->
                </div>
            </div>
            <?php require 'back-footer.php'; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>


</html>