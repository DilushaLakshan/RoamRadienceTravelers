<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                <div class="row">
                    <div class="col-12 mt-3">
                        <center>
                            <h4 class="stf-sub-heading">Bookings</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <!-- members main-->
                    <div class="col-12">
                        <div class="row">
                            <!-- headings -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <center>
                                            <span class="stf-sub-heading">Name</span>
                                        </center>
                                    </div>
                                    <div class="col-3">
                                        <center>
                                            <span class="stf-sub-heading">Date</span>
                                        </center>
                                    </div>
                                    <div class="col-3">
                                        <center>
                                            <span class="stf-sub-heading">Status</span>
                                        </center>
                                    </div>
                                    <div class="col-3"></div>
                                </div>
                            </div>
                            <!-- headings -->

                            <!-- details -->
                            <div class="col-12">
                                <div class="row">
                                    <?php
                                    // get all the booking records
                                    $bookingResultSet = Database::search("SELECT * FROM `booking` ORDER BY `date` DESC");
                                    $bookingNumRows = $bookingResultSet->num_rows;
                                    if ($bookingNumRows > 0) {
                                        for ($x = 0; $x < $bookingNumRows; $x++) {
                                            $bookingData = $bookingResultSet->fetch_assoc();

                                            // get user data according for the particular booking
                                            $travelerResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $bookingData['traveler_id'] . "'");
                                            $travelerNumRows = $travelerResultSet->num_rows;
                                            if ($travelerNumRows == 1) {
                                                $travelerData = $travelerResultSet->fetch_assoc();

                                    ?>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <span class="descriptions"><?php echo $travelerData["first_name"] . " " . $travelerData["last_name"]; ?></span>
                                                        </div>
                                                        <div class="col-3">
                                                            <span class="descriptions"><?php echo $bookingData["date"]; ?></span>
                                                        </div>
                                                        <div class="col-3">
                                                            <span class="descriptions">
                                                                <?php
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
                                                                ?>
                                                            </span>

                                                        </div>
                                                        <div class="col-3">
                                                            <button
                                                                class="btn sbt-button"
                                                                data-bs-toggle="collapse" data-bs-target="#booking<?php echo $x; ?>" aria-expanded="false" aria-controls="booking<?php echo $x; ?>">
                                                                View
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="collapse" id="booking<?php echo $x; ?>">
                                                        <div class="card card-body">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <?php
                                                                            $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $bookingData["tour_package_id"] . "'");
                                                                            $packageNumRows = $packageResultSet->num_rows;
                                                                            if ($packageNumRows == 1) {
                                                                                $packageData = $packageResultSet->fetch_assoc();
                                                                            ?>
                                                                                <div class="col-4">
                                                                                    <span class="descriptions"><b>Package Name</b></span><br>
                                                                                    <span class="descriptions"><?php echo $packageData["name"]; ?></span>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <span class="descriptions"><b>Availability</b></span><br>
                                                                                    <?php
                                                                                    $bookingRS2 = Database::search("SELECT * FROM `booking` WHERE `date`='" . $bookingData['date'] . "' AND `id`='" . $bookingData['tour_package_id'] . "'");
                                                                                    $bookingNR2 = $bookingRS2->num_rows;
                                                                                    if ($bookingNR2 == $packageData["no_of_vehicles"]) {
                                                                                    ?>
                                                                                        <span class="descriptions"><?php echo "No"; ?></span>
                                                                                    <?php
                                                                                    } else if ($bookingNR2 < $packageData["no_of_vehicles"]) {
                                                                                    ?>
                                                                                        <span id="availability" class="descriptions"><?php echo "Yes"; ?></span>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                        <span class="descriptions"><?php echo "No data"; ?></span>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <span class="descriptions"><b>No. of Seats (Vehicle)</b></span><br>
                                                                                    <span class="descriptions">10</span>
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <div class="col-4 mt-2">
                                                                                <span class="descriptions"><b>No. of Members</b></span><br>
                                                                                <span class="descriptions"><?php echo $bookingData["no_of_members"]; ?></span>
                                                                            </div>
                                                                            <div class="col-4 mt-2">
                                                                                <span class="descriptions"><b>Email</b></span><br>
                                                                                <span class="descriptions"><?php echo $travelerData["email"]; ?></span>
                                                                            </div>
                                                                            <div class="col-4 mt-2">
                                                                                <span class="descriptions"><b>Contact</b></span><br>
                                                                                <span class="descriptions"><?php echo $travelerData["contact"]; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mt-4">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-3 col-lg-3 offset-md-3 offset-lg-3 mt-2">
                                                                                <button class="btn sbt-button" onclick="updateStatus(<?php echo (int)$bookingData['traveler_id']; ?>, <?php echo $bookingData['id']; ?>, 2);">Confirm</button>
                                                                            </div>
                                                                            <div class="col-12 col-md-3 col-lg-3 mt-2">
                                                                                <button class="btn sbt-button" onclick="updateStatus(<?php echo (int)$bookingData['traveler_id']; ?>, <?php echo $bookingData['id']; ?>, 4);">Proceed to Payment</button>
                                                                            </div>
                                                                            <div class="col-12 col-md-3 col-lg-3 mt-2">
                                                                                <button class="btn sbt-button" onclick="updateStatus(<?php echo (int)$bookingData['traveler_id']; ?>, <?php echo $bookingData['id']; ?>, 3);">Reject</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- details -->
                    </div>
                </div>
                <!-- members main-->
            </div>

        </div>
    </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>