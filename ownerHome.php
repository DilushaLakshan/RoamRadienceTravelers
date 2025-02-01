<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body onload="displayGroupedBarChart();displayHardcodedChart();displayPieChart();">
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;

        // get the records according to the staff_member_id
        $staffResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `id`='" . $uID . "'");
        $staffNumRows = $staffResultSet->num_rows;
        if ($staffNumRows == 1) {
            $staffData = $staffResultSet->fetch_assoc();
    ?>
            <div class="container-fluid">
                <div class="row">
                    <?php
                    include 'back-header.php';
                    ?>
                    <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-5 mb-5 owner-main-container">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4 mt-2">
                                        <div class="w-100 mb-3 stat-card p-3">
                                            <div class="row g-0">
                                                <div class="col-4 d-flex justify-content-center align-items-center p-3">
                                                    <img src="resources/icons/customer.svg" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <div class="card-body">
                                                        <span class="text">
                                                            <?php
                                                            // Fetch the total customer count from the database
                                                            $customerResultSet = Database::search("SELECT COUNT(*) AS total FROM `traveler`");
                                                            $customerCount = $customerResultSet->fetch_assoc()['total'];
                                                            ?>
                                                            <h3><?php echo $customerCount; ?></h3>
                                                            <p>Customers</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mt-2">
                                        <div class="w-100 mb-3 stat-card p-3">
                                            <div class="row g-0">
                                                <div class="col-4 d-flex justify-content-center align-items-center p-3">
                                                    <img src="resources/icons/package.svg" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <div class="card-body">
                                                        <span class="text">
                                                            <!-- fetch the tour package count -->
                                                            <?php
                                                            $packageResultSet = Database::search("SELECT COUNT(*) AS packageCount FROM `tour_package` WHERE `validity`='true'");
                                                            $packageCount = $packageResultSet->fetch_assoc()['packageCount'];
                                                            ?>
                                                            <h3><?php echo $packageCount; ?></h3>
                                                            <p>Available Tour Packages</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mt-2">
                                        <div class="w-100 mb-3 stat-card p-3">
                                            <div class="row g-0">
                                                <div class="col-4 d-flex justify-content-center align-items-center p-3">
                                                    <img src="resources/icons/destination-smart.svg" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <div class="card-body">
                                                        <span class="text">
                                                            <?php
                                                            // get destination count
                                                            $desResultSet = Database::search("SELECT COUNT(*) AS destinationCount FROM `destination`");
                                                            $destinationCount = $desResultSet->fetch_assoc()['destinationCount'];
                                                            ?>
                                                            <h3><?php echo $destinationCount; ?></h3>
                                                            <p>Total Destinations</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mt-2">
                                        <div class="w-100 mb-3 stat-card p-3">
                                            <div class="row g-0">
                                                <div class="col-4 d-flex justify-content-center align-items-center p-3">
                                                    <img src="resources/icons/vehicle.svg" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <div class="card-body">
                                                        <span class="text">
                                                            <?php
                                                            $vehicleResultSet = Database::search("SELECT COUNT(*) AS vehicleCount FROM `vehicle`");
                                                            $vehicleCount = $vehicleResultSet->fetch_assoc()['vehicleCount'];
                                                            ?>
                                                            <h3><?php echo $vehicleCount; ?></h3>
                                                            <p>Vehicles</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mt-2">
                                        <div class="w-100 mb-3 stat-card p-3">
                                            <div class="row g-0">
                                                <div class="col-4 d-flex justify-content-center align-items-center p-3">
                                                    <img src="resources/icons/s-wheel.svg" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <div class="card-body">
                                                        <span class="text">
                                                            <?php
                                                            $driverResultSet = Database::search("SELECT COUNT(*) AS driverCount FROM `staff_member_new` WHERE `role`='driver'");
                                                            $driverCount = $driverResultSet->fetch_assoc()['driverCount'];
                                                            ?>
                                                            <h3><?php echo $driverCount; ?></h3>
                                                            <p>Drivers</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 mt-2">
                                        <div class="w-100 mb-3 stat-card p-3">
                                            <div class="row g-0">
                                                <div class="col-4 d-flex justify-content-center align-items-center p-3">
                                                    <img src="resources/icons/map.svg" alt="">
                                                </div>
                                                <div class="col-8">
                                                    <div class="card-body">
                                                        <span class="text">
                                                            <?php
                                                            $guideResultSet = Database::search("SELECT COUNT(*) AS guideCount FROM `staff_member_new` WHERE `role`='guide'");
                                                            $guideCount = $guideResultSet->fetch_assoc()['guideCount'];
                                                            ?>
                                                            <h3><?php echo $guideCount; ?></h3>
                                                            <p>Guides</p>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- visual data area -->
                            <div class="col-12 visual-data">
                                <div class="row">
                                    <div class="col-12 mt-3 content">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-6">
                                                <div class="dashboard-container card m-2">
                                                    <canvas class="chart-canvas" id="myChart"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-6">
                                                <center>
                                                    <div class="dashboard-container card m-2">
                                                        <canvas class="chart-canvas" id="pie-chart"></canvas>
                                                    </div>
                                                </center>
                                            </div>
                                            <div class="col-12">
                                                <div class="dashboard-container card m-2 p-2 pro-exp-area">
                                                    <div style="overflow-x: auto; white-space: nowrap;">
                                                        <canvas id="groupedBarChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Visual data area -->
                        </div>
                    </div>
                    <?php
                    include 'back-footer.php';
                    ?>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>