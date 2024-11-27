<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dirvers and Vehicles</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                <div class="row">
                    <div class="col-12 mt-4">
                        <center>
                            <h4 class="stf-sub-heading">Drivers and Vehicles</h4>
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

                            <!-- content -->
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <?php
                                    $driverResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `role`='driver'");
                                    $driverNumRows = $driverResultSet->num_rows;
                                    if ($driverNumRows > 0) {
                                        for ($x = 0; $x < $driverNumRows; $x++) {
                                            $driverData = $driverResultSet->fetch_assoc();
                                    ?>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <span class="descriptions"><?php echo  $driverData["first_name"] . " " . $driverData["last_name"]; ?></span>
                                                    </div>
                                                    <div class="col-3">
                                                        <span class="descriptions"><?php echo $driverData["role"]; ?></span>
                                                    </div>
                                                    <?php
                                                    $dvResultSet = Database::search("SELECT * FROM `driver` WHERE `staff_member_new_id`='" . $driverData['id'] . "'");
                                                    $dvNumRows = $dvResultSet->num_rows;
                                                    if ($dvNumRows == 1) {
                                                        $dvData = $dvResultSet->fetch_assoc();
                                                    ?>
                                                        <div class="col-3">
                                                            <span class="descriptions">Assigned</span>
                                                        </div>
                                                        <div class="col-3">
                                                            <button class="btn sbt-button" data-bs-toggle="collapse" data-bs-target="#driver-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="driver-area-<?php echo $x; ?>">
                                                                View
                                                            </button>
                                                        </div>
                                                        <?php
                                                        $vehicleResultSet = Database::search("SELECT * FROM `vehicle` WHERE `id`='" . $dvData['vehicle_id'] . "'");
                                                        $vehicleNumRows = $vehicleResultSet->num_rows;
                                                        if ($vehicleNumRows == 1) {
                                                            $vehicleData = $vehicleResultSet->fetch_assoc();
                                                        ?>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="driver-area-<?php echo $x; ?>">
                                                                    <div class="card card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Vehicle Type</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span><?php echo $vehicleData["type"]; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Vehicle Number</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span><?php echo $vehicleData["number"]; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Assigned vehicle</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <select name="" id="vehicle">
                                                                                            <option value="selection">Select vehicle</option>
                                                                                            <?php
                                                                                            $allVehicleRS = Database::search("SELECT * FROM `vehicle`");
                                                                                            $allVehicleNumRows = $allVehicleRS->num_rows;
                                                                                            if ($allVehicleNumRows > 0) {
                                                                                                for ($y = 0; $y < $allVehicleNumRows; $y++) {
                                                                                                    $allVehicleData = $allVehicleRS->fetch_assoc();
                                                                                            ?>
                                                                                                    <option
                                                                                                        value="<?php echo $allVehicleData['id']; ?>"
                                                                                                        <?php if ($dvData["vehicle_id"] == $allVehicleData["id"]) {
                                                                                                            echo "Selected";
                                                                                                        } ?>>
                                                                                                        <?php echo $allVehicleData["number"]; ?>
                                                                                                    </option>
                                                                                                <?php
                                                                                                }
                                                                                            } else {
                                                                                                ?>
                                                                                                <option value='-1'>No vehicles</option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-12 mt-4">
                                                                                        <button class="btn sbt-button w-50" onclick="manageDriverVehicle(<?php echo $driverData['id']; ?>);">Save changes</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="driver-area-<?php echo $x; ?>">
                                                                    <div class="card card-body">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Vehicle Type</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span>No</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Vehicle Number</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <span>No</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <span>Assigned vehicle</span>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <select name="" id="">
                                                                                            <option value="">ABC</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-12 mt-4">
                                                                                        <button class="btn sbt-button w-50" onclick="manageDriverVehicle(<?php echo $driverData['id']; ?>);">Save changes</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="col-3">
                                                            <span class="descriptions">Not assigned</span>
                                                        </div>
                                                        <div class="col-3">
                                                            <button class="btn sbt-button" data-bs-toggle="collapse" data-bs-target="#driver-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="driver-area-<?php echo $x; ?>">
                                                                View
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="collapse" id="driver-area-<?php echo $x; ?>">
                                                                <div class="card card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <span>Vehicle Type</span>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <span>No</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <span>Vehicle Number</span>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <span>No</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <span>Assigned vehicle</span>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <select name="" id="vehicle">
                                                                                        <option value="selection">Select vehicle</option>
                                                                                        <?php
                                                                                        $allVehicleRS = Database::search("SELECT * FROM `vehicle`");
                                                                                        $allVehicleNumRows = $allVehicleRS->num_rows;
                                                                                        if ($allVehicleNumRows > 0) {
                                                                                            for ($y = 0; $y < $allVehicleNumRows; $y++) {
                                                                                                $allVehicleData = $allVehicleRS->fetch_assoc();
                                                                                        ?>
                                                                                                <option value="<?php echo $allVehicleData['id']; ?>"><?php echo $allVehicleData["number"]; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                        } else {
                                                                                            ?>
                                                                                            <option value="">No vehicles</option>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 mt-4">
                                                                                    <button class="btn sbt-button w-50" onclick="manageDriverVehicle(<?php echo $driverData['id']; ?>);">Save changes</button>
                                                                                </div>
                                                                            </div>
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
                                    } else {
                                        ?>
                                        <div class="col-12 mt-2">
                                            <span><i>No drivers avaulable...</i></span>
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

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>