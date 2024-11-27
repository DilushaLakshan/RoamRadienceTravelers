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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                        <div class="row">
                            <div class="col-12 mt-4">
                                <center>
                                    <h4 class="stf-sub-heading">Welcome back, <?php echo $staffData["first_name"]; ?></h4>
                                </center>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="assignedVehicles.php" class="card-link">Assigned vehicles</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <div class="card w-100">
                                            <div class="card-body">
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <a href="#" class="card-link">Hiring Dates</a>
                                            </div>
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
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>