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
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- package cards -->
            <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-4 card-container">
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
                                                                <h5 class="card-title"><?php echo $tourPackageData["name"]; ?></h5>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-2">
                                                                <span>4.8 <i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
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
                                                    <div class="col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                <button class="btn package-button" onclick="window.location='updateTourPackage.php?pID=<?php echo $tourPackageData['id']; ?>'">Update Package</button>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                <button class="btn package-button">Desable Package</button>
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
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>