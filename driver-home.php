<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;

        $staffResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `id`='" . $uID . "'");
        $staffNumRows = $staffResultSet->num_rows;
        if ($staffNumRows == 1) {
            $staffData = $staffResultSet->fetch_assoc();
    ?>
            <div class="container-fluid back-main-container">
                <div class="row">
                    <?php include 'back-header.php'; ?>
                    <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 driver-home-container">
                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <center>
                                        <h4 class="stf-sub-heading">Welcome back, <?php echo $staffData["first_name"]; ?></h4>
                                    </center>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <a href="assignedVehicles.php" class="card-link">Assigned vehicles</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <a href="hr-date-dr.php" class="card-link">Hiring Dates</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'back-footer.php'; ?>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>