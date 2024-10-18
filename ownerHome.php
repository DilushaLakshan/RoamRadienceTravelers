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
    <div class="container-fluid">
        <div class="row">
            <!-- Button area -->
            <div class="col-12 col-md-3 col-lg-3 mt-5">
                <div class="overflow-auto scrollable-area" style="max-height: 80vh;">
                    <div class="col-12 p-4">
                        <div class="row">
                            <div class="col-12">
                                <button class="btn sbt-button" onclick="window.location.href='staff-registration.php'">Add New User</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='all-staff-members.php'">View Users</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='add-destination.php'">Add New Destination</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='back-destinations.php'">Manage Destination</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='addVehicle.php'">Add New Vehicle</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='manageVehicles.php'">Manage Vehicles</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='add-hotel.php'">Add New Hotel</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href=''">Manage Hotels</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='add-tourpackage.php'">Add New Tour Package</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='stf-tPackages.php'">Manage Tour Packages</button>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn sbt-button" onclick="window.location.href='bookings.php'">Manage Bookings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button area -->

            <!-- Visual data area -->
            <div class="col-12 col-md-9 col-lg-9 mt-5">
                <div class="overflow-auto scrollable-area" style="max-height: 80vh;">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h4 class="stf-sub-heading">Available Tour Packages and sales</h4>
                                <button onclick="displayHardcodedChart();">Bar chart</button>
                            </center>
                        </div>
                        <div class="col-12">
                            <div class="dashboard-container">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <center>
                                <h4 class="stf-sub-heading">Monthly sales</h4>
                                <button onclick="displayLineChart();">Line chart</button>
                            </center>
                        </div>
                        <div class="col-12">
                            <div class="dashboard-container">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <center>
                                <h4 class="stf-sub-heading">Monthly Profit and expenses</h4>
                                <button onclick="displayGroupedBarChart();">Display Grouped Chart</button>
                            </center>
                        </div>
                        <div class="col-12">
                            <div class="dashboard-container">
                                <canvas id="groupedBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Visual data area -->
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>