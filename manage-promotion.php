<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Promotions</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid back-main-container">
        <div class="row">
            <?php
            include 'back-header.php';
            ?>
            <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-2 mb-5 p-3 promotion-list-container">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h4 class="stf-sub-heading">Manage Promotions</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            $promotionResultSet = Database::search("SELECT * FROM `promotion`");
                            $promotionNumRows = $promotionResultSet->num_rows;
                            if ($promotionNumRows > 0) {
                                for ($x = 0; $x < $promotionNumRows; $x++) {
                                    $promotionData = $promotionResultSet->fetch_assoc();
                            ?>
                                    <div class="col-12 mt-2">
                                        <div class="card promotion-card">
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4 col-lg-4">
                                                            <?php
                                                            if (empty($promotionData["image_src"])) {
                                                            ?>
                                                                <img src="resources/images/ Jetavanaramaya66c61e61ef655.png" alt="">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resources/images/<?php echo $promotionData['image_src']; ?>" alt="">
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-12 col-md-8 col-lg-8">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h5><?php echo $promotionData["header_text"]; ?></h5>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="card-text"><b>Discount</b> - <?php echo $promotionData["discount"]; ?>% off</p>
                                                                    <p class="card-text"><?php echo $promotionData["details"]; ?></p>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <p class="card-text"><b>Available from - </b> <?php echo $promotionData["starting_date"]; ?> <b>to - </b> <?php echo $promotionData["end_date"]; ?></p>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <p class="card-text"><b>Valid Status - </b> <?php if ($promotionData["status"] == "yes") {
                                                                                                                        echo "Enabled";
                                                                                                                    } else {
                                                                                                                        echo "Disabled";
                                                                                                                    } ?></p>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <p class="card-text">
                                                                        <b>Assign Status - </b>
                                                                        <?php
                                                                        $assignResultSet = Database::search("SELECT * FROM `tour_package_has_promotion` WHERE `promotion_id`='" . $promotionData['id'] . "'");
                                                                        $assignNumRows = $assignResultSet->num_rows;
                                                                        if ($assignNumRows > 0) {
                                                                            echo "Yes " . "(No. of package - )" . $assignNumRows;
                                                                        } else {
                                                                            echo "No";
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <p id="selectedIdList-<?php echo $promotionData['id']; ?>"></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn" onclick="window.location='update-promotion.php?proID=<?php echo $promotionData['id']; ?>'">
                                                                                Update
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn" onclick="upadtePromotionStatus(<?php echo $promotionData['id']; ?>, 'yes');">
                                                                                Enable
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn" onclick="upadtePromotionStatus(<?php echo $promotionData['id']; ?>, 'no');">
                                                                                Disable
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4 offset-lg-4 mt-3">
                                                                            <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#selection-model" onclick="document.getElementById('promo-id').innerHTML = <?php echo $promotionData['id']; ?>">
                                                                                Assign
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn" onclick="assignPackagePromo(<?php echo $promotionData['id']; ?>);">
                                                                                Save Changes
                                                                            </button>
                                                                        </div>
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
                            } else {
                                ?>
                                <div class="col-12 mt-2">
                                    <center>
                                        <span><i>No available promotions</i></span>
                                    </center>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- package selection model -->
            <div class="col-12 package-selection-form">
                <div class="modal fade" id="selection-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title stf-sub-heading fs-5" id="exampleModalLabel">Select Tour Packages - Promo ID - <span id="promo-id"></span></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="row">
                                        <?php
                                        $tourPackageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `validity`='true'");
                                        $tourPackageNumRows = $tourPackageResultSet->num_rows;
                                        if ($tourPackageNumRows > 0) {
                                            for ($x = 0; $x < $tourPackageNumRows; $x++) {
                                                $tourPackageData = $tourPackageResultSet->fetch_assoc();
                                        ?>
                                                <div class="col-12">
                                                    <div class="card mb-3 package-card">
                                                        <div class="row g-0">
                                                            <div class="col-md-4 p-3">
                                                                <?php
                                                                $imageResultSet = Database::search("SELECT * FROM `package_photo` WHERE `tour_package_id`='" . $tourPackageData['id'] . "' AND `type`='main'");
                                                                $imageNumRows = $imageResultSet->num_rows;
                                                                if ($imageNumRows == 1) {
                                                                    $imageData = $imageResultSet->fetch_assoc();
                                                                ?>
                                                                    <img src="resources/images/<?php echo $imageData['source']; ?>" class="img-fluid rounded-star package-thumnail-image">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="resources/images/default -image.svg" class="img-fluid rounded-star package-thumnail-image">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-8 col-lg-10">
                                                                                    <h5 class="card-title"><?php echo $tourPackageData["name"]; ?></h5>
                                                                                </div>
                                                                            </div> <?php
                                                                                    // get the destination id list of the perticular tour package
                                                                                    $desNamesList = [];
                                                                                    $destinationResultSet = Database::search("SELECT * FROM `destination_has_tour_package` WHERE `tour_package_id`='" . $tourPackageData['id'] . "'");
                                                                                    $destinationNumRows = $destinationResultSet->num_rows;
                                                                                    if ($destinationNumRows > 0) {
                                                                                        for ($y = 0; $y < $destinationNumRows; $y++) {
                                                                                            $destinationData = $destinationResultSet->fetch_assoc();

                                                                                            // get destination details from the destination table
                                                                                            $desDetailsResultSet = Database::search("SELECT * FROM `destination` WHERE `id`='" . $destinationData['destination_id'] . "'");
                                                                                            $desDetailsNumRows = $desDetailsResultSet->num_rows;
                                                                                            if ($desDetailsNumRows > 0) {
                                                                                                for ($z = 0; $z < $desDetailsNumRows; $z++) {
                                                                                                    $desDetailsData = $desDetailsResultSet->fetch_assoc();
                                                                                                    array_push($desNamesList, $desDetailsData["name"]);
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                            <span>
                                                                                Destinations :
                                                                                <?php
                                                                                if (!empty($desNamesList)) {
                                                                                    for ($a = 0; $a < sizeof($desNamesList); $a++) {
                                                                                        echo ($desNamesList[$a] . " , ");
                                                                                    }
                                                                                } else {
                                                                                    echo "<i>No data</i>";
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                            <?php
                                                                            ?>
                                                                        </div>
                                                                        <div class="col-12 mt-3">
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                                    <span>
                                                                                        Duration -
                                                                                        <?php
                                                                                        // get the duration data
                                                                                        $durationResultSet = Database::search("SELECT * FROM `duration` WHERE `id`='" . $tourPackageData['duration_id'] . "'");
                                                                                        $durationNumRows = $durationResultSet->num_rows;
                                                                                        if ($durationNumRows == 1) {
                                                                                            $durationData = $durationResultSet->fetch_assoc();
                                                                                            echo $durationData["name"];
                                                                                        } else {
                                                                                            echo "<i>No data</i>";
                                                                                        }
                                                                                        ?>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                                    <span>Price - <?php echo $tourPackageData["price"]; ?> LKR</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-3">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <span>Operating Languages - English/ Sinhala</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-3 d-flex align-items-center">
                                                                            <input type="checkbox" name="selection" id="selection" value="<?php echo $tourPackageData['id']; ?>">
                                                                            <label for="selection" class="ms-2">Select</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="col-12">
                                                <center>
                                                    <span><i>No results found...</i></span>
                                                </center>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4 mt-2">
                                            <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4 mt-2">
                                            <button type="button" class="btn" onclick="getPackageList();">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- package selection model -->
             <?php include 'back-footer.php'; ?>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>