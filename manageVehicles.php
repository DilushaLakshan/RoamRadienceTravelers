<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h4 class="stf-sub-heading">Vehicles</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <!-- members main -->
                    <div class="col-12">
                        <div class="row">
                            <!-- headings -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-3">
                                        <center>
                                            <span class="stf-sub-heading">Vehicle Num</span>
                                        </center>
                                    </div>
                                    <div class="col-3">
                                        <center>
                                            <span class="stf-sub-heading">Type</span>
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
                                    $vehicleResultSet = Database::search("SELECT * FROM `vehicle`");
                                    $vehicleNumRows = $vehicleResultSet->num_rows;
                                    if ($vehicleNumRows > 0) {
                                        for ($x = 0; $x < $vehicleNumRows; $x++) {
                                            $vehicleData = $vehicleResultSet->fetch_assoc();
                                    ?>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <span class="descriptions"><?php echo $vehicleData["number"]; ?></span>
                                                    </div>
                                                    <div class="col-3">
                                                        <span class="descriptions"><?php echo $vehicleData["type"]; ?></span>
                                                    </div>
                                                    <div class="col-3">
                                                        <?php
                                                        $assignResultSet = Database::search("SELECT * FROM `vehicle_has_tour_package` WHERE `vehicle_id`='" . $vehicleData['id'] . "'");
                                                        $assignNumRows = $assignResultSet->num_rows;
                                                        if ($assignNumRows == 0) {
                                                        ?>
                                                            <span class="descriptions">Not Assigned</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="descriptions">Assigned</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="btn sbt-button" data-bs-toggle="collapse" data-bs-target="#area-<?php echo $x; ?>" aria-expanded="false" aria-controls="area-<?php echo $x; ?>">
                                                            View
                                                        </button>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="collapse" id="area-<?php echo $x; ?>">
                                                            <div class="card card-body">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <span>No. of Seats</span><br>
                                                                            <span><?php echo $vehicleData["no_of_seat"]; ?></span>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <span>Price per day</span><br>
                                                                            <span><?php echo $vehicleData["price_per_day"]; ?></span>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <span>Price per km.</span><br>
                                                                            <span><?php echo $vehicleData["price_per_km"]; ?></span>
                                                                        </div>
                                                                        <div class="col-12 mt-4">
                                                                            <div class="col-12 col-md-3 col-lg-3 offset-md-9 offset-lg-9 mt-2">
                                                                                <button class="btn sbt-button" data-bs-toggle="collapse" data-bs-target="#input-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="input-area-<?php echo $x; ?>">Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- input area -->
                                                                <div class="col-12 collapse mt-3" id="input-area-<?php echo $x; ?>">
                                                                    <div class="row">
                                                                        <div class="col-12 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <span>Vehicle Number</span>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" id="v-num" class="w-100" value="<?php echo $vehicleData['number']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <span>No. of Seats</span>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="number" id="v-seats" class="w-100" value="<?php echo $vehicleData['no_of_seat']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <span>Price per KM</span>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" id="v-price-km" class="w-100" value="<?php echo $vehicleData['price_per_km']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <span>Price per day</span>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <input type="text" id="v-price-day" class="w-100" value="<?php echo $vehicleData['price_per_day']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-4">
                                                                            <div class="col-12 col-md-3 col-lg-3 offset-md-9 offset-lg-9 mt-2">
                                                                                <button class="btn sbt-button" onclick="updateVehicle(<?php echo $vehicleData['id']; ?>);">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- input area -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-12 mt-3">
                                            <center>
                                                <span class="descriptions"><i>No data...</i></span>
                                            </center>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- details -->
                        </div>
                    </div>
                    <!-- members main -->
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>