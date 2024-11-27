<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Tour Packages</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <!-- package cards -->
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-4 mb-3 card-container">
                    <div class="row">
                        <?php
                        $tourPackageResultSet = Database::search("SELECT * FROM `tour_package`");
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
                                                                    <h5 class="card-title stf-sub-heading"><?php echo $tourPackageData["name"]; ?></h5>
                                                                </div>
                                                                <div class="col-12 col-md-4 col-lg-2">
                                                                    <?php
                                                                    $feedbackResultSet = Database::search("SELECT AVG(`rate_status`) AS `rating` FROM `package_comment` WHERE `tour_package_id` = {$tourPackageData['id']} AND `rate_status` IS NOT NULL");
                                                                    $feedbackNumRows = $feedbackResultSet->num_rows;
                                                                    if ($feedbackNumRows == 1) {
                                                                        $feedbackData = $feedbackResultSet->fetch_assoc();
                                                                        $rating = round($feedbackData['rating'], 1);
                                                                    } else {
                                                                        $rating = 0;
                                                                    }
                                                                    ?>
                                                                    <span class="p-description">
                                                                        <b><?php echo $rating; ?></b>
                                                                        <i class="fa-solid fa-star star-filled"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <?php
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
                                                            <span class="descriptions">
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
                                                                    <span class="descriptions">
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
                                                                    <span class="descriptions">Price - <?php echo $tourPackageData["price"]; ?> LKR</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="descriptions">Operating Languages - English/ Sinhala</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="descriptions">Validity - <?php echo $tourPackageData["validity"]; ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                    <button class="btn sbt-button" onclick="updatePackageStatus(<?php echo $tourPackageData['id']; ?>,'true');">Enable Package</button>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                    <button class="btn sbt-button" onclick="updatePackageStatus(<?php echo $tourPackageData['id']; ?>, 'false');">Desable Package</button>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                    <button class="btn sbt-button" onclick="window.location='updateTourPackage.php?pID=<?php echo $tourPackageData['id']; ?>'">Update Package</button>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                    <button class="btn sbt-button" onclick="window.location='package-details-staff.php?pID=<?php echo $tourPackageData['id']; ?>'">View Details</button>
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
                <!-- package cards -->
                <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>