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
                                <h3 class="sub-heading"><?php echo $packageData["name"]; ?></h3>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="p-description">4.8
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-heading">
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
                                                            <?php
                                                            $imageResultSet = Database::search("SELECT * FROM `package_photo` WHERE `tour_package_id`='" . $packageID . "' AND `type`='main'");
                                                            $imageNumRows = $imageResultSet->num_rows;
                                                            if ($imageNumRows == 1) {
                                                                $imageData = $imageResultSet->fetch_assoc();
                                                            ?>
                                                                <img src="resources/images/<?php echo $imageData['source']; ?>" class="d-block package-carousel-image">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resources/images/default -image.svg" class="d-block package-carousel-image">
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- carousel -->

                                            <div class="col-12 mt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5 class="sub-heading">Tour Gilde</h5>
                                                        <span class="p-description">Mr. Perera YW</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="sub-heading">Price</h5>
                                                        <span class="p-description"><?php echo $packageData["price"]; ?> LKR</span>
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
                                                            <button
                                                                onclick="" class="btn"
                                                                data-bs-toggle="collapse" data-bs-target="#slot-availability" aria-expanded="false" aria-controls="slot-availability">
                                                                Check availability
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <p class="p-description"><img src="resources/images/booking.svg" class="package-include-icon"><b>Easy payments </b>with smaller, interest-free instalments.</p>
                                                            <p class="p-description"><img src="resources/images/booking.svg" class="package-include-icon"><b>Book once </b>and share the cost with split payments</p>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="collapse" id="slot-availability">
                                                                <div class="card card-body">
                                                                    <input type="date" id="checking-date" onchange="checkPackageAvailability(<?php echo $packageID; ?>);">
                                                                    <span class="p-description mt-3"><b>Availability : <span id="available-status"></span></b></span>
                                                                    <button
                                                                        class="btn mt-3"
                                                                        data-bs-toggle="collapse" data-bs-target="#booking-data" aria-expanded="false" aria-controls="booking-data">
                                                                        Proceed
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="collapse" id="booking-data">
                                                                <div class="card card-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <span class="p-description">No. of Members</span>
                                                                            </div>
                                                                            <div class="col-12 mt-2">
                                                                                <input type="number" id="booking-members">
                                                                            </div>
                                                                            <div class="col-12 mt-2">
                                                                                <span class="p-description">Description</span>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <textarea name="" id="booking-des" rows="3"></textarea>
                                                                            </div>
                                                                            <button class="btn mt-3" onclick="sendBookingData(<?php echo $packageID; ?>);">Confirm Booking</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                        <h5 class="sub-heading">Description</h5>
                                        <span class="p-description"><?php echo $packageData["description"]; ?></span>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h5 class="sub-heading">From our travelers</h5>
                                        <a class="btn p-description" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i>Click here to expand</i>
                                        </a>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body mt-2">
                                                <span class="p-description">"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quos facere, non est, praesentium cupiditate doloremque libero ab quisquam molestiae minus illo quis voluptatum eos nulla quo explicabo quod ipsa? Quas."</span>
                                                <br>
                                                <span class="sub-heading"><i><b>June 2024 - Traveler name</b></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h5 class="sub-heading">What's included</h5>
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
                                            <p class="p-description"><i>No services available...</i></p>
                                        <?php
                                        }

                                        // Display services
                                        for ($z = 0; $z < sizeof($serviceNameList); $z++) {
                                            echo "<p><img src='resources/images/correct.svg' class='package-include-icon'><b class='p-description'>" . $serviceNameList[$z] . "</b></p>";
                                        }
                                        ?>
                                    </div>


                                    <div class="col-12 mt-4">
                                        <h5 class="sub-heading">Highlights</h5>
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
                                            <p class="p-description"><i>No data available...</i></p>
                                        <?php
                                        }
                                        for ($a = 0; $a < sizeof($highlighNametList); $a++) {
                                        ?>
                                            <p class="p-description"><img src="resources/images/like.svg" class="package-include-icon"><?php echo $highlighNametList[$a]; ?></p>
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