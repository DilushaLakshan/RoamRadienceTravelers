<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Vehicles</title>
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
                <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <center>
                                <h4 class="stf-sub-heading">Vehicles</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <!-- members main-->
                        <div class="col-12 mt-2">
                            <div class="row">
                                <!-- headings -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <center>
                                                <span class="stf-sub-heading">Vehicle Type</span>
                                            </center>
                                        </div>
                                        <div class="col-4">
                                            <center>
                                                <span class="stf-sub-heading">Number</span>
                                            </center>
                                        </div>
                                        <div class="col-4"></div>
                                    </div>
                                </div>
                                <!-- headings -->

                                <!-- content -->
                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <?php
                                        $dvResultSet = Database::search("SELECT * FROM `driver` WHERE `staff_member_new_id`='" . $uID . "'");
                                        $dvNumRows = $dvResultSet->num_rows;
                                        if ($dvNumRows > 0) {
                                            for ($x = 0; $x < $dvNumRows; $x++) {
                                                $dvData = $dvResultSet->fetch_assoc();

                                                $vehicleresultSet = Database::search("SELECT * FROM `vehicle` WHERE `id`='" . $dvData['vehicle_id'] . "'");
                                                $vehicleNumRows = $vehicleresultSet->num_rows;
                                                if ($vehicleNumRows == 1) {
                                                    $vehicleData = $vehicleresultSet->fetch_assoc();
                                        ?>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <span class="descriptions"><?php echo $vehicleData["type"]; ?></span>
                                                            </div>
                                                            <div class="col-4">
                                                                <span class="descriptions"><?php echo $vehicleData["number"]; ?></span>
                                                            </div>
                                                            <div class="col-4">
                                                                <button class="sbt-button" data-bs-toggle="collapse" data-bs-target="#dv-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="dv-area-<?php echo $x; ?>">View</button>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="dv-area-<?php echo $x; ?>">
                                                                    <div class="card card-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <span class="descriptions"><b>Booking dates</b></span><br>
                                                                                <?php
                                                                                $vehiclePackageResultSet = Database::search("SELECT * FROM `vehicle_has_tour_package` WHERE `vehicle_id`='" . $vehicleData['id'] . "'");
                                                                                $vehiclePackageNumRows = $vehiclePackageResultSet->num_rows;
                                                                                if ($vehiclePackageNumRows > 0) {
                                                                                    for ($y = 0; $y < $vehiclePackageNumRows; $y++) {
                                                                                        $vehiclePackageData = $vehiclePackageResultSet->fetch_assoc();

                                                                                        $statusID = 2;
                                                                                        $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `tour_package_id`='" . $vehiclePackageData['tour_package_id'] . "' AND `status_id`='" . $statusID . "'");
                                                                                        $bookingNumRows = $bookingResultSet->num_rows;
                                                                                        if ($bookingNumRows > 0) {
                                                                                            for ($z = 0; $z < $bookingNumRows; $z++) {
                                                                                                $bookingData = $bookingResultSet->fetch_assoc();
                                                                                ?>
                                                                                                <span class="descriptions"><?php echo $bookingData["date"]; ?></span>
                                                                                            <?php
                                                                                            }
                                                                                        } else {
                                                                                            ?>
                                                                                            <span class="descriptions">No bookings available</span>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <span class="descriptions">Vehicle has not been assigned with package</span>
                                                                                <?php
                                                                                }
                                                                                ?>
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
                                        } else {
                                            ?>
                                            <div class="col-12 mt-2">
                                                <center>
                                                    <span class="descriptions"><i>No vehicles assigned...</i></span>
                                                </center>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- content -->
                            </div>
                        </div>
                        <!-- members main-->
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>