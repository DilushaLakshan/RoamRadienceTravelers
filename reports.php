<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-2 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h4 class="stf-sub-heading">Reports</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <!-- visual data area -->
                        <div class="col-12">
                            <div>
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
                <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>