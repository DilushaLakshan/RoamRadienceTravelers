<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guides and Packages</title>
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
                <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 guide-package-list-container">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <center>
                                <h4 class="stf-sub-heading">Guides and Packages</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 mt-4">
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
                                                <span class="stf-sub-heading">Role</span>
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
                                <!-- members -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <?php
                                        $guideResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `role`='guide'");
                                        $guideNumRows = $guideResultSet->num_rows;
                                        if ($guideNumRows > 0) {
                                            for ($x = 0; $x < $guideNumRows; $x++) {
                                                $guideData = $guideResultSet->fetch_assoc();
                                        ?>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <div class="col-3"><p><?php echo $guideData["first_name"] . " " . $guideData["last_name"]; ?></p></div>
                                                        <div class="col-3"><p><?php echo $guideData["role"]; ?></p></div>
                                                        <?php
                                                        $guidePackResultSet = Database::search("SELECT * FROM `guide` WHERE `staff_member_new_id`='" . $guideData['id'] . "'");
                                                        $guidePackNumRows = $guidePackResultSet->num_rows;
                                                        if ($guidePackNumRows == 1) {
                                                            $guidePackData = $guidePackResultSet->fetch_assoc();
                                                        ?>
                                                            <div class="col-3"><p>Assigned</p></div>
                                                            <div class="col-3">
                                                                <button class="btn" data-bs-toggle="collapse" data-bs-target="#guide-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="guide-area-<?php echo $x; ?>">View</button>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="guide-area-<?php echo $x; ?>">
                                                                    <div class="card card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <span><b>Select a package for assign</b></span><br>
                                                                                <select name="" id="package-<?php echo $x; ?>">
                                                                                    <option value="<?php echo 0; ?>">Select a Package</option>
                                                                                    <?php
                                                                                    $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `validity`='true'");
                                                                                    $packageNumRows = $packageResultSet->num_rows;
                                                                                    if ($packageNumRows > 0) {
                                                                                        for ($y = 0; $y < $packageNumRows; $y++) {
                                                                                            $packageData = $packageResultSet->fetch_assoc();
                                                                                    ?>
                                                                                            <option value="<?php echo $packageData['id']; ?>"><?php echo $packageData["name"]; ?></option>
                                                                                        <?php
                                                                                        }
                                                                                    } else {
                                                                                        ?>
                                                                                        <option value="-1">No packages available</option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <span><b>Booking Dates</b></span><br>
                                                                                <?php
                                                                                $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `tour_package_id`='" . $guidePackData['tour_package_id'] . "'");
                                                                                $bookingNumRows = $bookingResultSet->num_rows;
                                                                                if ($bookingNumRows > 0) {
                                                                                    for ($z = 0; $z < $bookingNumRows; $z++) {
                                                                                        $bookingData = $bookingResultSet->fetch_assoc();
                                                                                ?>
                                                                                        <p><?php echo $bookingData["date"]; ?></p>
                                                                                    <?php
                                                                                    }
                                                                                } else {
                                                                                    ?>
                                                                                    <p><i>No bookings</i></p>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <button class="btn" onclick="manageGuideWithPackage(<?php echo $guideData['id']; ?>, <?php echo $x; ?>);">Save changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-3"><p><i>Not assigned</i></p></div>
                                                            <div class="col-3">
                                                                <button class="btn" data-bs-toggle="collapse" data-bs-target="#guide-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="guide-area-<?php echo $x; ?>">View</button>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="guide-area-<?php echo $x; ?>">
                                                                    <div class="card card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <span><b>Select a package for assign</b></span><br>
                                                                                <select name="" id="package-<?php echo $x; ?>">
                                                                                    <option value="<?php echo 0; ?>">Select a Package</option>
                                                                                    <?php
                                                                                    $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `validity`='true'");
                                                                                    $packageNumRows = $packageResultSet->num_rows;
                                                                                    if ($packageNumRows > 0) {
                                                                                        for ($y = 0; $y < $packageNumRows; $y++) {
                                                                                            $packageData = $packageResultSet->fetch_assoc();
                                                                                    ?>
                                                                                            <option value="<?php echo $packageData['id']; ?>"><?php echo $packageData["name"]; ?></option>
                                                                                        <?php
                                                                                        }
                                                                                    } else {
                                                                                        ?>
                                                                                        <option value="-1">No packages available</option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <p><b>Booking Dates</b></p><br>
                                                                                <p></p>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <button class="btn" onclick="manageGuideWithPackage(<?php echo $guideData['id']; ?>, <?php echo $x; ?>);">Save changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- members -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>