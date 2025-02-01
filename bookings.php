<?php
session_start();
require 'connection.php';
?>
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
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid back-main-container">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-3 mb-3 booking-list-container">
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
                                                                <p><?php echo $travelerData["first_name"] . " " . $travelerData["last_name"]; ?></p>
                                                            </div>
                                                            <div class="col-3">
                                                                <p><?php echo $bookingData["date"]; ?></p>
                                                            </div>
                                                            <div class="col-3">
                                                                <p>
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
                                                                </p>

                                                            </div>
                                                            <div class="col-3">
                                                                <button
                                                                    class="btn"
                                                                    data-bs-toggle="collapse" data-bs-target="#booking-<?php echo $x; ?>" aria-expanded="false" aria-controls="booking-<?php echo $x; ?>">
                                                                    View
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="collapse" id="booking-<?php echo $x; ?>">
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
                                                                                        <span><b>Package Name</b></span><br>
                                                                                        <p><?php echo $packageData["name"]; ?></p>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span><b>Vehicle Availability</b></span><br>
                                                                                        <?php
                                                                                        // check the vehicle avalability according to the date and touring members - fetch data from the vehicle table
                                                                                        $vehicleResultSet = Database::search("SELECT * FROM `vehicle` WHERE `no_of_seat`>='" . $bookingData['no_of_members'] . "'");
                                                                                        $vehicleNumRows = $vehicleResultSet->num_rows;
                                                                                        if ($vehicleNumRows > 0) {
                                                                                            $bookedVehicle = [];
                                                                                            $notBookedVehicle = [];

                                                                                            for ($m = 0; $m < $vehicleNumRows; $m++) {
                                                                                                $vehicleData = $vehicleResultSet->fetch_assoc();

                                                                                                $bookingRS2 = Database::search("SELECT * FROM `booking` WHERE `date` = '" . $bookingData['date'] . "' AND `vehicle_id` = '" . $vehicleData['id'] . "'");
                                                                                                $bookingNR2 = $bookingRS2->num_rows;

                                                                                                if ($bookingNR2 > 0) {
                                                                                                    // Vehicle is booked, add its ID to the bookedVehicle list
                                                                                                    $bookingData2 = $bookingRS2->fetch_assoc();
                                                                                                    array_push($bookedVehicle, $bookingData2["vehicle_id"]);
                                                                                                } else {
                                                                                                    // Vehicle is not booked, add its ID to the notBookedVehicle list
                                                                                                    array_push($notBookedVehicle, $vehicleData['id']);
                                                                                                }
                                                                                            }

                                                                                            if (sizeof($notBookedVehicle) > 0) {
                                                                                        ?>
                                                                                                <p id="availability"><?php echo "Yes"; ?></p>
                                                                                            <?php
                                                                                            } else {
                                                                                            ?>
                                                                                                <p id="availability"><?php echo "No"; ?></p>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span><b>No. of Seats Available (Vehicle)</b></span><br>
                                                                                        <p>10</p>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span><b>Set vehicle</b></span><br>
                                                                                        <?php
                                                                                        if ($bookingData["vehicle_id"] != 7) {
                                                                                        ?>
                                                                                            <p>Yes</p>
                                                                                            <?php
                                                                                            $assignedVehicleRS = Database::search("SELECT * FROM `vehicle` WHERE `id`='" . $bookingData['vehicle_id'] . "'");
                                                                                            $assigneVehicleNR = $assignedVehicleRS->num_rows;
                                                                                            if ($assigneVehicleNR == 1) {
                                                                                                $assignedVehicleData = $assignedVehicleRS->fetch_assoc();
                                                                                            ?>
                                                                                                <p><?php echo $assignedVehicleData["number"] . " : " . $assignedVehicleData["type"]; ?></p>
                                                                                            <?php
                                                                                            } else {
                                                                                            ?>
                                                                                                <p><i>No data</i></p>
                                                                                            <?php
                                                                                            }
                                                                                        } else {
                                                                                            ?>
                                                                                            <p>No</p>
                                                                                        <?php
                                                                                        }
                                                                                        ?>

                                                                                    </div>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                <div class="col-4 mt-2">
                                                                                    <span><b>No. of Members</b></span><br>
                                                                                    <p><?php echo $bookingData["no_of_members"]; ?></p>
                                                                                </div>
                                                                                <div class="col-4 mt-2">
                                                                                    <span><b>Email</b></span><br>
                                                                                    <p><?php echo $travelerData["email"]; ?></p>
                                                                                </div>
                                                                                <div class="col-4 mt-2">
                                                                                    <span><b>Contact</b></span><br>
                                                                                    <p><?php echo $travelerData["contact"]; ?></p>
                                                                                </div>
                                                                                <div class="col-4 mt-2">
                                                                                    <span><b>Amout to Pay</b></span><br>
                                                                                    <p><?php echo $packageData["price"] * $bookingData["no_of_members"]; ?></p>
                                                                                </div>
                                                                                <div class="col-4 mt-2">
                                                                                    <span><b>Special Discount</b></span><br>
                                                                                    <input type="number" id="spec-dis-<?php echo $bookingData['id']; ?>" value="<?php echo $bookingData['special_discount']; ?>">
                                                                                    <a href="#" onclick="setSpecDiscount(<?php echo $bookingData['id']; ?>);" class="btn mt-2">Set Discount</a>
                                                                                </div>
                                                                                <div class="col-12 mt-2">
                                                                                    <div class="row">
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span><b>Payment</b></span><br>
                                                                                        <?php
                                                                                        $paymentResultSet = Database::search("SELECT * FROM `payment` WHERE `booking_id`='" . $bookingData['id'] . "'");
                                                                                        $paymentNumRows = $paymentResultSet->num_rows;
                                                                                        if ($paymentNumRows == 1) {
                                                                                            $paymentData = $paymentResultSet->fetch_assoc();
                                                                                            if ($paymentData["status"] == "yes") {
                                                                                        ?>
                                                                                                <p>Yes</p>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span><b>Paid Amount</b></span><br>
                                                                                        <p><?php echo $paymentData["amount"] ?></p>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span><b>Total Discount</b></span><br>
                                                                                        <p><?php echo $paymentData["discount"] ?></p>
                                                                                    </div>
                                                                                <?php
                                                                                            } else {
                                                                                ?>
                                                                                    <p>No</p>
                                                                                </div>
                                                                            <?php
                                                                                            }
                                                                            ?>
                                                                        <?php
                                                                                        } else {
                                                                        ?>
                                                                            <p>No payment data</p>
                                                                        <?php
                                                                                        }

                                                                        ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 mt-4">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-3 col-lg-3 mt-2">
                                                                            <button class="btn" data-bs-toggle="collapse" data-bs-target="#vehicle-list-<?php echo $x; ?>" aria-expanded="false" aria-controls="vehicle-list-<?php echo $x; ?>">Assign vehicle</button>
                                                                        </div>
                                                                        <div class="col-12 col-md-3 col-lg-3 mt-2">
                                                                            <button class="btn" onclick="updateStatus(<?php echo (int)$bookingData['traveler_id']; ?>, <?php echo $bookingData['id']; ?>, 2);">Confirm</button>
                                                                        </div>
                                                                        <div class="col-12 col-md-3 col-lg-3 mt-2">
                                                                            <button class="btn" onclick="updateStatus(<?php echo (int)$bookingData['traveler_id']; ?>, <?php echo $bookingData['id']; ?>, 4);">Proceed to Payment</button>
                                                                        </div>
                                                                        <div class="col-12 col-md-3 col-lg-3 mt-2">
                                                                            <button class="btn" onclick="updateStatus(<?php echo (int)$bookingData['traveler_id']; ?>, <?php echo $bookingData['id']; ?>, 3);">Reject</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- collapse area - vehicle list -->
                                                                <div class="col-12 mt-4">
                                                                    <div class="collapse" id="vehicle-list-<?php echo $x; ?>">
                                                                        <div class="card card-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <span><b>Available vehicles</b></span><br>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="row">
                                                                                        <?php
                                                                                        // fetch all vehicle records
                                                                                        $vResultSet2 = Database::search("SELECT * FROM `vehicle`");
                                                                                        $vNumRows2 = $vResultSet2->num_rows;

                                                                                        if ($vNumRows2 > 0) {
                                                                                            $bookedVehicleIdList = [];
                                                                                            $notBookedVehicleIdList = [];

                                                                                            for ($y = 0; $y < $vNumRows2; $y++) {
                                                                                                $vData2 = $vResultSet2->fetch_assoc();

                                                                                                $bookingResultSet3 = Database::search("SELECT * FROM `booking` WHERE `date`='" . $bookingData['date'] . "' AND `vehicle_id`='" . $vData2['id'] . "'");
                                                                                                $bookingNumRows3 = $bookingResultSet3->num_rows;

                                                                                                if ($bookingNumRows3 == 1) {
                                                                                                    $bookingData3 = $bookingResultSet3->fetch_assoc();
                                                                                                    array_push($bookedVehicleIdList, $vData2["id"]);
                                                                                                } else {
                                                                                                    array_push($notBookedVehicleIdList, $vData2["id"]);
                                                                                                }
                                                                                            }

                                                                                            // fetch all vehicles available on particular date
                                                                                            for ($z = 0; $z < sizeof($notBookedVehicleIdList); $z++) {
                                                                                                $availableVehicleResultSet = Database::search("SELECT * FROM `vehicle` WHERE `id`='" . $notBookedVehicleIdList[$z] . "'");
                                                                                                $availableVehicleNumRows = $availableVehicleResultSet->num_rows;

                                                                                                if ($availableVehicleNumRows == 1) {
                                                                                                    $availableVehicleData = $availableVehicleResultSet->fetch_assoc();
                                                                                        ?>
                                                                                                    <div class="col-12 col-md-4 col-lg-4 inline-radio">
                                                                                                        <input type="radio" name="available-vehicle" value="<?php echo $availableVehicleData['id']; ?>" <?php if ($bookingData["vehicle_id"] == $availableVehicleData["id"]) {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        } ?>>
                                                                                                        <label for="available-vehicle-input"><?php echo $availableVehicleData["number"] . " - " . $availableVehicleData["type"]; ?></label>
                                                                                                    </div>
                                                                                        <?php
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <div class="col-12 col-md-3 col-lg-3 offset-md-9 offset-lg-9">
                                                                                            <button class="btn" onclick="setVehicleBooking(<?php echo $bookingData['id'] ?>);">Save Changes</button>
                                                                                        </div>
                                                                                        <?php
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- collapse area - vehicle list -->
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
        <?php include 'back-footer.php'; ?>
        </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>