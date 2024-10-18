<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
                $uID = 0;
                include 'navbar.php';
            }
            ?>
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-5">
                <div class="row">
                    <?php
                    if (isset($_SESSION["user"])) {
                        $uID = $_SESSION["user"]->id;

                        $travelerResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $uID . "'");
                        $travelerNumRows = $travelerResultSet->num_rows;
                        if ($travelerNumRows == 1) {
                            $travelerData = $travelerResultSet->fetch_assoc();
                    ?>
                            <div class="col-12 mt-2">
                                <center>
                                    <h3 class="sub-heading">Welcome back, <?php echo ($travelerData["first_name"]); ?></h3>
                                </center>
                            </div>

                            <!-- profile data -->
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">First Name:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['first_name']; ?>" id="fName">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Last Name:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['last_name']; ?>" id="lName">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Email:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['email']; ?>" id="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Password:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="password" class="w-100" value="<?php echo $travelerData['password']; ?>" id="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Contact:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['contact']; ?>" id="contact">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Home No.:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['house_no']; ?>" id="hNo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Street 1:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['street_1']; ?>" id="street1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Street 2:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['street_2']; ?>" id="street2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <button class="btn profile-buttons w-100" onclick="updateTraveler();">Save changes</button>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <button class="btn profile-buttons w-100">Deactivate Account</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile data -->
                    <?php

                        }
                    }
                    ?>

                    <div class="col-12 mt-3">
                        <hr>
                    </div>

                    <!-- booking histrory -->

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12">
                                <center>
                                    <h4 class="sub-heading">Booking history</h4>
                                </center>
                            </div>
                            <?php
                            $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `traveler_id`='" . $uID . "'");
                            $bookingNumRows = $bookingResultSet->num_rows;
                            if ($bookingNumRows > 0) {
                            ?>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="sub-heading">Date</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="sub-heading">Status</span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                for ($x = 0; $x < $bookingNumRows; $x++) {
                                    $bookingData = $bookingResultSet->fetch_assoc();
                                ?>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6 col-md-4 col-lg-4">
                                                        <span class="descriptions"><?php echo $bookingData["date"]; ?></span>
                                                    </div>
                                                    <div class="col-6 col-md-4 col-lg-4">
                                                        <span class="descriptions"><?php
                                                                                    if ($bookingData["status_id"] == 1) {
                                                                                        echo "Pending";
                                                                                    } else if ($bookingData["status_id"] == 2) {
                                                                                        echo "Confirmed";
                                                                                    } else if ($bookingData["status_id"] == 3) {
                                                                                        echo "Rejected";
                                                                                    } else if ($bookingData["status_id"] == 4) {
                                                                                        echo "Proceed to Payment";
                                                                                    } else {
                                                                                        echo "No data";
                                                                                    }
                                                                                    ?></span>
                                                    </div>
                                                    <div class="col-12 col-md-4 col-lg-4">
                                                        <center>
                                                            <a class="btn profile-buttons" data-bs-toggle="collapse" href="#area-<?php echo $x; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $x; ?>">
                                                                View Details
                                                            </a>
                                                        </center>
                                                    </div>
                                                    <!-- collapse content -->
                                                    <div class="col-12 mt-2 mb-2">
                                                        <div class="collapse" id="area-<?php echo $x; ?>">
                                                            <div class="card card-body">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <?php
                                                                        $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $bookingData['tour_package_id'] . "'");
                                                                        $packageNumRows = $packageResultSet->num_rows;
                                                                        if ($packageNumRows == 1) {
                                                                            $packageData = $packageResultSet->fetch_assoc();
                                                                        ?>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Price</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span><?php echo $packageData["price"]; ?> LKR</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Milage</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span><?php echo $packageData["total_milage"]; ?> KM</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Duration</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <?php
                                                                                        $durationResultSet = Database::search("SELECT * FROM `duration` WHERE `id`='" . $packageData['duration_id'] . "'");
                                                                                        $durationNumRows = $durationResultSet->num_rows;
                                                                                        if ($durationNumRows == 1) {
                                                                                            $durationData = $durationResultSet->fetch_assoc();
                                                                                        ?>
                                                                                            <span><?php echo $durationData["name"]; ?></span>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Guide</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span>Fernando JW</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Date</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span><?php echo $bookingData["date"]; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Discounts</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span>-</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- collapse content -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            <?php
                            } else {
                            ?>
                                <div class="col-12 mt-3">
                                    <span class="descriptions">
                                        <i>No matching records...</i>
                                    </span>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- booking histrory -->
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>