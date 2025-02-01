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

<body onload="barChartForReporting();displayGroupedBarChart();">
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <div class="col-12 mt-2 mb-3 reporting-section">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-10 col-lg-10 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <label for="start-date">From :</label>
                                            <input type="date" id="full-report-st-date">
                                            <label for="end-date" class="mt-2">To :</label>
                                            <input type="date" id="full-report-ed-date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 col-lg-2 ">
                                    <center>
                                        <button
                                            class="btn"
                                            data-bs-toggle="collapse" data-bs-target="#full-report-callapse-area"
                                            aria-expanded="false" aria-controls="full-report-callapse-area"
                                            onclick="generateFullReport();">
                                            Generate Full Report
                                        </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-10 col-ld-10 offset-md-1 offset-lg-1 mt-3">
                            <div class="collapse" id="full-report-callapse-area">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-12" id="full-report-section"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <!-- visual data area -->
                        <div class="col-12 visual-chart-section">
                            <div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-10 col-lg-10 mt-2">
                                                <center>
                                                    <h4>Available Tour Packages and sales</h4>
                                                </center>
                                            </div>
                                            <div class="col-12 col-md-2 col-lg-2">
                                                <button onclick="barChartForReporting();">Package chart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-10 col-ld-10 offset-md-1 offset-lg-1">
                                        <div class="dashboard-container">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 col-md-10 col-lg-10 mt-2">
                                                        <center>
                                                            <h4>Monthly sales</h4>
                                                        </center>
                                                    </div>
                                                    <div class="col-12 col-md-2 col-lg-2">
                                                        <button onclick="displayLineChart();">Sales chart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 col-md-3 col-lg-3">
                                                        <label for="from">From : </label>
                                                        <input type="date" id="date-from">
                                                        <label for="from" class="mt-2">To : </label>
                                                        <input type="date" id="date-to">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-10 col-ld-10 offset-md-1 offset-lg-1">
                                        <div class="dashboard-container">
                                            <canvas id="lineChart"></canvas>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-10 col-lg-10">
                                                <center>
                                                    <h4>Monthly Profit and expenses</h4>
                                                </center>
                                            </div>
                                            <div class="col-12 col-md-2 col-lg-2">
                                                <button onclick="displayGroupedBarChart();">Expense Chart</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-10 col-ld-10 offset-md-1 offset-lg-1">
                                        <div class="dashboard-container">
                                            <canvas id="groupedBarChart"></canvas>
                                        </div>
                                    </div> -->
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>