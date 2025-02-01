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
        <div class="container-fluid back-main-container">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 assigned-vehicle-list-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <!-- Heading -->
                                <div class="col-md-8 text-md-start text-center mt-2 mt-md-0">
                                    <h4 class="stf-sub-heading">Vehicles</h4>
                                </div>
                                <!-- Button -->
                                <div class="col-md-4 text-md-end text-center mt-2 mt-md-0">
                                    <a href="driver-home.php" class="d-inline-flex align-items-center hover-move">
                                        <img src="resources/icons/back-arrow.svg" alt="" class="me-2 arrow-icon">
                                        Back to Home
                                    </a>
                                </div>
                            </div>
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
                                                                <p><?php echo $vehicleData["type"]; ?></p>
                                                            </div>
                                                            <div class="col-4">
                                                                <p><?php echo $vehicleData["number"]; ?></p>
                                                            </div>
                                                            <div class="col-4">
                                                                <button data-bs-toggle="collapse" data-bs-target="#dv-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="dv-area-<?php echo $x; ?>">View</button>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="dv-area-<?php echo $x; ?>">
                                                                    <div class="card card-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <span><b>Booking dates</b></span><br>
                                                                                <?php
                                                                                $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `vehicle_id`='" . $vehicleData['id'] . "'");
                                                                                $bookingNumRows = $bookingResultSet->num_rows;
                                                                                if ($bookingNumRows > 0) {
                                                                                    for ($a = 0; $a < $bookingNumRows; $a++) {
                                                                                        $bookingData = $bookingResultSet->fetch_assoc();
                                                                                ?>
                                                                                        <p><?php echo $bookingData["date"]; ?></p>
                                                                                    <?php
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <p><i>No bookings available...</i></p>
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
                                                    <span><i>No vehicles assigned...</i></span>
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
                <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>