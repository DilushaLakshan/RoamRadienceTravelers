<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Package</title>
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
                            <h4>Add New Tour Package</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Name of the Package</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Price</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="price">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Header Text</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="h-text">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Description</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <textarea name="" id="description" rows="15" class="w-100"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Select the Destinations</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Click here to select destinations
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <span id="desIDList"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Number of Vehicles</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="number" class="w-100" id="no-of-vehicles">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Select the Vehicles</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vehicle-selection-model">
                                            Click here to select vehicles
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <span id="v-id-list"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Select the Hotel</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotel-selection-model">
                                    Click here to select hotels
                                </button>
                                <div class="col-12">
                                    <span id="hotel-id-list"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Duration</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <?php
                                    $durationResultSet = Database::search("SELECT * FROM `duration`");
                                    $durationNumRows = $durationResultSet->num_rows;
                                    if ($durationNumRows > 0) {
                                        for ($p = 0; $p < $durationNumRows; $p++) {
                                            $durationData = $durationResultSet->fetch_assoc();
                                    ?>
                                            <div class="col-6 col-md-4 col-lg-4">
                                                <input type="radio" name="duration" value="<?php echo $durationData['id']; ?>"> <?php echo $durationData["name"]; ?>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Activities Type</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="col-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type" value="cultural"> Cultural
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type" value="adventure"> Adventure
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type" value="wildlife & nature"> Wildlife & Nature
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type" value="hiking"> Hiking
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type" value="beach & coastal"> Beach & Coastal
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type" value="photography"> Photography
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type" value="luxury"> Luxury
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Included services</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="col-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <?php
                                        $serviceResultSet = Database::search("SELECT * FROM `package_includes`");
                                        $serviceNumRows = $serviceResultSet->num_rows;
                                        if ($serviceNumRows > 0) {
                                            for ($m = 0; $m < $serviceNumRows; $m++) {
                                                $serviceData = $serviceResultSet->fetch_assoc();
                                        ?>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <input type="checkbox" name="services" value="<?php echo $serviceData['id']; ?>"> <?php echo $serviceData["name"]; ?>
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <input type="checkbox" name="type" value="0"> no Data
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Highlights</label><br>
                                <span><i>(Use ',' to seperate sentences)</i></span>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <textarea name="" id="highlight" rows="10" class="w-100"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Total Milage (KM)</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="number" class="w-100" id="milage">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <span>Main Image:</span>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8 mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <input class="form-control w-100" type="file" id="main-image" accept=".png, .jpg, .jpeg" onclick="mainImagePreview();">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <center><img alt="" id="m-image" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/default -image.svg"></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <span>Other Images:</span>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8 mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <input class="form-control w-100" type="file" id="optional-images" accept=".png, .jpg, .jpeg" onclick="optionalImagePreview();" multiple>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <center><img alt="" id="img-1" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <center><img alt="" id="img-2" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <center><img alt="" id="img-3" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <center><img alt="" id="img-4" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <button class="btn btn-primary w-100">Clear</button>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <button class="btn btn-primary w-100" onclick="addTourPackage();">ADD</button>
                            </div>
                        </div>
                    </div>

                    <!-- destination selecttion model -->
                    <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Select the list of destinations</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <?php
                                                $destinationResultSet = Database::search("SELECT * FROM `destination` ORDER BY `id` DESC");
                                                $destinationNumRows = $destinationResultSet->num_rows;
                                                if ($destinationNumRows > 0) {
                                                    for ($x = 0; $x < $destinationNumRows; $x++) {
                                                        $destinationData = $destinationResultSet->fetch_assoc();
                                                ?>
                                                        <div class="col-12 col-md-4 col-lg-4">
                                                            <div class="card w-100 border-0">
                                                                <?php
                                                                $imageResultSet = Database::search("SELECT * FROM `destination_photo` WHERE `destination_id`='" . $destinationData['id'] . "' LIMIT 1");
                                                                $imageNumRows = $imageResultSet->num_rows;
                                                                if ($imageNumRows > 0) {
                                                                    $imageData = $imageResultSet->fetch_assoc();
                                                                ?>
                                                                    <img style="height: 200px;" src="resources/images/<?php echo $imageData['src']; ?>" class="card-img-top" alt="...">

                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="resources/images/default -image.svg" class="card-img-top" alt="...">
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="card-body">
                                                                    <input type="checkbox" name="destination" value="<?php echo $destinationData['id']; ?>">
                                                                    <h6 class="card-title"><?php echo $destinationData["name"]; ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="col-12">
                                                        <span>
                                                            <i>No results found</i>
                                                        </span>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="getDestinationIDs();">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- destination selecttion model -->

                    <!-- vehicle selection model -->
                    <div class="modal fade" id="vehicle-selection-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select Vehicles</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            $vehicleResultSet = Database::search("SELECT * FROM `vehicle`");
                                            $vehicleNumRows = $vehicleResultSet->num_rows;
                                            if ($vehicleNumRows > 0) {
                                                for ($a = 0; $a < $vehicleNumRows; $a++) {
                                                    $vehicleData = $vehicleResultSet->fetch_assoc();
                                            ?>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="checkbox" name="v-id" value="<?php echo $vehicleData['id']; ?>">
                                                            </div>
                                                            <div class="col-6">
                                                                <span><?php echo $vehicleData["number"]; ?></span>
                                                            </div>
                                                            <div class="col-4">
                                                                <span><?php echo $vehicleData["type"]; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-12">
                                                    <center>
                                                        <span><i>No results found</i></span>
                                                    </center>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="getVehicleIDs();">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- vehicle selection model -->

                    <!-- hotel selection model -->
                    <div class="modal fade" id="hotel-selection-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            $hotelResultSet = Database::search("SELECT * FROM `hotel`");
                                            $hotelNumRows = $hotelResultSet->num_rows;
                                            if ($hotelNumRows > 0) {
                                                for ($b = 0; $b < $hotelNumRows; $b++) {
                                                    $hotelData = $hotelResultSet->fetch_assoc();
                                            ?>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="checkbox" name="hotel" value="<?php echo $hotelData['id']; ?>">
                                                            </div>
                                                            <div class="col-6">
                                                                <span><?php echo $hotelData["name"]; ?></span>
                                                            </div>
                                                            <div class="col-4">
                                                                <span><?php echo $hotelData["address"]; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-12">
                                                    <span><i>No results found</i></span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="getHotelIDs();">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- hotel selection model -->
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>