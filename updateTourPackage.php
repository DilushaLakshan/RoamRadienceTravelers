<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tour Package</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_GET["pID"])) {
                $packageID = $_GET["pID"];
                // get tour package data from tour_package table
                $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $packageID . "'");
                $packageNumRows = $packageResultSet->num_rows;
                if ($packageNumRows == 1) {
                    $packageData = $packageResultSet->fetch_assoc();
            ?>
                    <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                        <div class="row">
                            <div class="col-12">
                                <center>
                                    <h4 class="stf-sub-heading">Update Tour Package</h4>
                                </center>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Name of the Package</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <input type="text" class="w-100" id="name" value="<?php echo $packageData['name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Price</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <input type="text" class="w-100" id="price" value="<?php echo $packageData['price']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Header Text</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <input type="text" class="w-100" id="h-text" value="<?php echo $packageData['header_text']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Description</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <textarea name="description" id="description" rows="15" class="w-100"><?php echo $packageData["description"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Select the Destinations</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn sbt-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Click here to select destinations
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <span id="desIDList" class="descriptions"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Number of Vehicles</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <input type="number" class="w-100" id="no-of-vehicles" value="<?php echo $packageData['no_of_vehicles']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Select the Vehicles</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                // get vehicle IDs
                                                $vehicleResultSet = Database::search("SELECT * FROM `vehicle_has_tour_package` WHERE `tour_package_id`='" . $packageID . "'");
                                                $vehicleNumRows = $vehicleResultSet->num_rows;
                                                if ($vehicleNumRows > 0) {
                                                    for ($a = 0; $a < $vehicleNumRows; $a++) {
                                                        $vehicleData = $vehicleResultSet->fetch_assoc();

                                                        // get vehicle details from the vehicle relation
                                                        $vDetailsResultSet = Database::search("SELECT * FROM `vehicle` WHERE `id`='" . $vehicleData['vehicle_id'] . "'");
                                                        $vDetailsNumRows = $vDetailsResultSet->num_rows;
                                                        if ($vDetailsNumRows == 1) {
                                                            $vDetailsData = $vDetailsResultSet->fetch_assoc();
                                                ?>
                                                            <span class="descriptions"><?php echo $vDetailsData["number"] . " - " . $vDetailsData["type"] . " / "; ?></span>
                                                    <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <span class="descriptions"><i>No vehicles...</i></span>
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
                                        <label class="descriptions">Selected Hotels</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="col-12">
                                            <?php
                                            // get hotel id list
                                            $hotelResultSet = Database::search("SELECT * FROM `hotel_has_tour_package` WHERE `tour_package_id`='" . $packageID . "'");
                                            $hotelNumRows = $hotelResultSet->num_rows;
                                            if ($hotelNumRows > 0) {
                                                for ($b = 0; $b < $hotelNumRows; $b++) {
                                                    $hotelData = $hotelResultSet->fetch_assoc();

                                                    // get hotel details
                                                    $hDetailsResultSet = Database::search("SELECT * FROM `hotel` WHERE `id`='" . $hotelData['hotel_id'] . "'");
                                                    $hDetailsNumRows = $hDetailsResultSet->num_rows;
                                                    if ($hDetailsNumRows == 1) {
                                                        $hDetailsData = $hDetailsResultSet->fetch_assoc();
                                            ?>
                                                        <span class="descriptions"><?php echo $hDetailsData["name"] . " - " . $hDetailsData["address"] . " <br/> <br/>"; ?></span>
                                                <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <span class="descriptions"><i>No hotel data...</i></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Duration</label>
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
                                                        <input type="radio" name="duration" value="<?php echo $durationData['id']; ?>"
                                                            <?php
                                                            if ($packageData["duration_id"] == $durationData["id"]) {
                                                                echo "checked";
                                                            }
                                                            ?>> <?php echo $durationData["name"]; ?>
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
                                        <label class="descriptions">Activities Type</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <div class="row">
                                                <?php
                                                $activityResultSet = Database::search("SELECT * FROM `activity_type`");
                                                $activityNumRows = $activityResultSet->num_rows;
                                                if ($activityNumRows > 0) {
                                                    for ($e = 0; $e < $activityNumRows; $e++) {
                                                        $activityData = $activityResultSet->fetch_assoc();
                                                ?>
                                                        <div class="col-12 col-md-6 col-lg-6">
                                                            <input type="checkbox" name="type" value=<?php echo $activityData["id"]; ?>> <?php echo $activityData["name"]; ?>
                                                        </div>
                                                <?php
                                                    }
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
                                        <label class="descriptions">Included services</label>
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
                                        <label class="descriptions">Highlights</label><br>
                                        <span class="descriptions"><i>(Use ',' to seperate sentences)</i></span>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <textarea name="" id="highlight" rows="10" class="w-100">
                                            <?php
                                            $highlightResultSet = Database::search("SELECT * FROM `package_highlights` WHERE `tour_package_id`='" . $packageID . "'");
                                            $highightNumRows = $highlightResultSet->num_rows;
                                            if ($highightNumRows > 0) {
                                                for ($e = 0; $e < $highightNumRows; $e++) {
                                                    $highlightData = $highlightResultSet->fetch_assoc();
                                                    echo ($highlightData["description"] . ", ");
                                                }
                                            }
                                            ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <label class="descriptions">Total Milage (KM)</label>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <input type="number" class="w-100" id="milage" value="<?php echo $packageData['total_milage']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <span class="descriptions">Main Image:</span>
                                    </div>
                                    <div class="col-12 col-md-8 col-lg-8 mt-2">
                                        <div class="row">
                                            <?php
                                            // get package images
                                            $mResultSet = Database::search("SELECT * FROM `package_photo` WHERE `tour_package_id`='" . $packageID . "' AND `type`='main'");
                                            $mNumRows = $mResultSet->num_rows;
                                            if ($mNumRows == 1) {
                                                $mData = $mResultSet->fetch_assoc();
                                            ?>
                                                <div class="col-12">
                                                    <input class="form-control w-100" type="file" id="main-image" accept=".png, .jpg, .jpeg" onclick="mainImagePreview();">
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <center><img alt="" id="m-image" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/<?php echo $mData['source']; ?>"></center>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <input class="form-control w-100" type="file" id="main-image" accept=".png, .jpg, .jpeg" onclick="mainImagePreview();">
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <center><img alt="" id="m-image" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/default -image.svg"></center>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn sbt-button">Clear</button>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn sbt-button" onclick="updateTourPackage(<?php echo $packageID; ?>);">Save Changes</button>
                                    </div>
                                </div>
                            </div>

                            <!-- destination selecttion model -->
                            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title stf-sub-heading fs-5" id="exampleModalLabel">Select the list of destinations</h1>
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
                                                                            <h6 class="card-title descriptions"><?php echo $destinationData["name"]; ?></h6>
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
                                                <button type="button" class="btn sbt-button" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn sbt-button" onclick="getDestinationIDs();">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- destination selecttion model -->
                        </div>
                    </div>
                <?php
                }
                ?>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>

</html>