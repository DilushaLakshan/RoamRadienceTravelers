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
        <div class="container-fluid back-main-container">
            <div class="row">
                <?php include 'back-header.php' ?>
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 assigned-package-list-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <!-- Heading -->
                                <div class="col-md-8 text-md-start text-center mt-2 mt-md-0">
                                    <h4 class="stf-sub-heading">Packages</h4>
                                </div>
                                <!-- Button -->
                                <div class="col-md-4 text-md-end text-center mt-2 mt-md-0">
                                    <a href="guide-home.php" class="d-inline-flex align-items-center hover-move">
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
                                                            <div class="col-4"><p class="descriptions"><?php echo $packageData["name"]; ?></p></div>
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

                                                                        <p><?php echo $bookingData["date"]; ?></p>

                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <div class="col-4">
                                                                        <p><i>No bookings</i></p>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                </div>
                                                                <div class="col-4">
                                                                    <button onclick="window.location='pack-detail-gd-view.php?pID=<?php echo $packageData['id']; ?>'" href="">View package</button onclick="window.location=''">
                                                                </div>
                                                            </div>
                                                    </div>
                                                <?php
                                            }
                                        } else {
                                                ?>
                                                <div class="col-12 mt-2">
                                                    <center>
                                                        <p><i>You have not been assigned with travel package...</i></p>
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