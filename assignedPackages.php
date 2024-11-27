<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned packages</title>
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
                                <h4 class="stf-sub-heading">Packages</h4>
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
                                                <span class="stf-sub-heading">Package Name</span>
                                            </center>
                                        </div>
                                        <div class="col-4">
                                            <center>
                                                <span class="stf-sub-heading">Booking dates</span>
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
                                        // check the particular guide is assigned with a travel package 
                                        $guidePackageResultSet = Database::search("SELECT * FROM `guide` WHERE `staff_member_new_id`='" . $uID . "'");
                                        $guidePackageNumRows = $guidePackageResultSet->num_rows;
                                        if ($guidePackageNumRows > 0) {
                                            for ($x = 0; $x < $guidePackageNumRows; $x++) {
                                                $guidePackageData = $guidePackageResultSet->fetch_assoc();

                                        ?>
                                                <div class="col-12 mt-2">
                                                    <div class="row">

                                                        <?php
                                                        $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $guidePackageData['tour_package_id'] . "'");
                                                        $packageNumRows = $packageResultSet->num_rows;
                                                        if ($packageNumRows == 1) {
                                                            $packageData = $packageResultSet->fetch_assoc();
                                                        ?>
                                                            <div class="col-4"><span class="descriptions"><?php echo $packageData["name"]; ?></span></div>
                                                            <div class="col-4">
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <div class="col-4"></div>
                                                                <div class="col-4">
                                                                    <?php
                                                                }
                                                                $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `tour_package_id`='" . $guidePackageData['tour_package_id'] . "'");
                                                                $bookingNumRows = $bookingResultSet->num_rows;
                                                                if ($bookingNumRows > 0) {
                                                                    for ($y = 0; $y < $bookingNumRows; $y++) {
                                                                        $bookingData = $bookingResultSet->fetch_assoc();
                                                                    ?>

                                                                        <span class="descriptions"><?php echo $bookingData["date"]; ?></span><br>

                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <div class="col-4">
                                                                        <span class="descriptions"><i>No bookings</i></span>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                </div>
                                                                <div class="col-4">
                                                                    <a href="" class="descriptions">View package</a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                <?php
                                            }
                                        } else {
                                                ?>
                                                <div class="col-12 mt-2">
                                                    <center>
                                                        <span><i>Uoy have not been assigned with travel package...</i></span>
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