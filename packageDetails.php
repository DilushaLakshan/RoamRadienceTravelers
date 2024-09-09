<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Details</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_SESSION["user"])) {
                $uID = $_SESSION["user"]->id;

                include 'navbar-logged-in.php';
            } else {
                include 'navbar.php';
            }

            if (isset($_GET["pID"])) {
                $packageID = $_GET["pID"];
            ?>
                <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1">
                    <div class="row">
                        <?php
                        // get the tour package details
                        $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $packageID . "'");
                        $packageNumRows = $packageResultSet->num_rows;
                        if ($packageNumRows == 1) {
                            $packageData = $packageResultSet->fetch_assoc();
                        ?>
                            <div class="col-12 mt-3">
                                <h3><?php echo $packageData["name"]; ?></h3>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span>4.8
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span>
                                            <?php
                                            // get the duration data
                                            $durationResultSet = Database::search("SELECT * FROM `duration` WHERE `id`='" . $packageData['duration_id'] . "'");
                                            $durationNumRows = $durationResultSet->num_rows;
                                            if ($durationNumRows == 1) {
                                                $durationData = $durationResultSet->fetch_assoc();
                                                echo ("<b>" . $durationData["name"] . "</b>");
                                            } else {
                                                echo ("<i>No duration data</i>");
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <!-- carousel side-->
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="row">
                                            <!-- carousel -->
                                            <div class="col-12">
                                                <div id="carouselExampleSlidesOnly" class="carousel slide main-carousel-package" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="resources/images/Temple of the Tooth Relic66c621824801b.png" class="d-block package-carousel-image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- carousel -->

                                            <div class="col-12 mt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Tour Gilde</h5>
                                                        <span>Mr. Perera YW</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5>Price</h5>
                                                        <span><?php echo $packageData["price"]; ?> LKR</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- carousel side-->
                                    <!-- right side -->
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="card package-details-card">
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="card-title"><?php echo ($packageData["price"] . ".00"); ?> LKR</h5>
                                                            <p class="card-text"></p>
                                                            <a href="#" class="btn btn-primary button">Check availability</a>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <p><img src="resources/images/booking.svg" class="package-include-icon"><b>Easy payments </b>with smaller, interest-free instalments.</p>
                                                            <p><img src="resources/images/booking.svg" class="package-include-icon"><b>Book once </b>and share the cost with split payments</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- right side -->
                                </div>
                            </div>

                            <!-- left side -->
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <h5>Description</h5>
                                        <span><?php echo $packageData["description"]; ?></span>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h5>From our travelers</h5>
                                        <a class="btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i>Click here to expand</i>
                                        </a>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body mt-2">
                                                <span>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quos facere, non est, praesentium cupiditate doloremque libero ab quisquam molestiae minus illo quis voluptatum eos nulla quo explicabo quod ipsa? Quas."</span>
                                                <br>
                                                <span><i><b>June 2024 - Traveler name</b></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h5>What's included</h5>
                                        <?php
                                        // get service ids
                                        $serviceNameList = [];
                                        $servicesResultSet = Database::search("SELECT * FROM `package_includes_has_tour_package` WHERE `tour_package_id`='" . $packageID . "'");
                                        $serviceNumRows = $servicesResultSet->num_rows;

                                        if ($serviceNumRows > 0) {
                                            for ($x = 0; $x < $serviceNumRows; $x++) {
                                                $serviceData = $servicesResultSet->fetch_assoc();

                                                // get service details from the package_includes table
                                                $includeResultSet = Database::search("SELECT * FROM `package_includes` WHERE `id`='" . $serviceData['package_includes_id'] . "'");
                                                $includeNumRows = $includeResultSet->num_rows;
                                                if ($includeNumRows == 1) {
                                                    $includeData = $includeResultSet->fetch_assoc();
                                                    array_push($serviceNameList, $includeData["name"]);
                                                }
                                            }
                                        } else {
                                        ?>
                                            <p><i>No services available...</i></p>
                                        <?php
                                        }

                                        // Display services
                                        for ($z = 0; $z < sizeof($serviceNameList); $z++) {
                                            echo "<p><img src='resources/images/correct.svg' class='package-include-icon'><b>" . $serviceNameList[$z] . "</b></p>";
                                        }
                                        ?>
                                    </div>


                                    <div class="col-12 mt-4">
                                        <h5>Highlights</h5>
                                        <?php
                                        // get highlights
                                        $highlighNametList = [];
                                        $highlightResultSet = Database::search("SELECT * FROM `package_highlights` WHERE `tour_package_id`='" . $packageID . "'");
                                        $highlighNumRows = $highlightResultSet->num_rows;
                                        if ($highlighNumRows > 0) {
                                            for ($y = 0; $y < $highlighNumRows; $y++) {
                                                $highlightData = $highlightResultSet->fetch_assoc();
                                                array_push($highlighNametList, $highlightData["description"]);
                                            }
                                        } else {
                                        ?>
                                            <p><i>No data available...</i></p>
                                        <?php
                                        }
                                        for ($a = 0; $a < sizeof($highlighNametList); $a++) {
                                        ?>
                                            <p><img src="resources/images/like.svg" class="package-include-icon"><?php echo $highlighNametList[$a]; ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- left side -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>