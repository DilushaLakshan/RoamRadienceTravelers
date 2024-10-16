<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour packages</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_SESSION["user"])) {
                $uID = $_SESSION["user"]->id;
                include 'navbar-logged-in.php';
            } else {
                $uID = 0;
                include 'navbar.php';
            }
            ?>

            <!-- main banner -->
            <div class="col-12 mt-3">
                <div class="card text-bg-dark banner-image-contanier">
                    <img src="resources/images/hero-image.jpg" class="card-img banner-image" alt="...">
                    <div class="card-img-overlay">
                        <h3 class="card-title">Free up your mind</h3>
                        <p class="card-text">Let's travel</p>
                        <button class="btn banner-image-button">Explore Journeys</button>
                    </div>
                </div>
            </div>
            <!-- main banner -->

            <!-- package cards -->
            <div class="col-12">
                <div class="row">
                    <!-- filter area -->
                    <div class="col-12 col-md-4 col-lg-4 p-md-3 p-lg-5 filter-area">
                        <div class="overflow-auto scrollable-area" style="max-height: 80vh;">
                            <div class="col-12 p-4">
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <h3 class="filter-heading  m-2"><img src="resources/images/filter-icon.svg" alt="" class="filter-icon" /> Apply Filters</h3>
                                        </center>
                                    </div>
                                    <div class="col-12">
                                        <span class="sub-heading">Price</span>
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input type="radio" id="l-h" name="sort-price">
                                                    </div>
                                                    <div class="col-10">
                                                        <label for="">Low to high</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input type="radio" id="h-l" name="sort-price">
                                                    </div>
                                                    <div class="col-10">
                                                        <label for="">High to low</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <span class="sub-heading">Duration</span>
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            $durResultSet = Database::search("SELECT * FROM `duration`");
                                            $durNumRows = $durResultSet->num_rows;
                                            if ($durNumRows > 0) {
                                                for ($k = 0; $k < $durNumRows; $k++) {
                                                    $durData = $durResultSet->fetch_assoc();
                                            ?>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="checkbox" name="duration" value="<?php echo $durData['id']; ?>">
                                                            </div>
                                                            <div class="col-10">
                                                                <label for=""><?php echo $durData["name"]; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-12 mt-2">
                                                    <span><i>No data</i></span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <span class="sub-heading">Activities</span>
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            $activityResultSet = Database::search("SELECT * FROM `activity_type`");
                                            $activityNumRows = $activityResultSet->num_rows;
                                            if ($activityNumRows > 0) {
                                                for ($e = 0; $e < $activityNumRows; $e++) {
                                                    $activityData = $activityResultSet->fetch_assoc();
                                            ?>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="checkbox" name="activity-type" value=<?php echo $activityData["id"]; ?>>
                                                            </div>
                                                            <div class="col-10">
                                                                <label><?php echo $activityData["name"]; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-12 mt-2">
                                                    <span><i>No data</i></span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-12 mt-3 p-5">
                                                <button class="btn package-button" onclick="appplyFilters();">Apply Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- filter area -->

                    <!-- package cards -->
                    <div class="col-12 col-md-8 col-lg-8 p-md-3 p-lg-5">
                        <div class="overflow-auto scrollable-area" style="max-height: 80vh;" id="packageArea">
                            <div class="col-12 p-2">
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
                                                                    <div class="col-12 mt-3">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <button class="btn package-button" onclick="window.location = 'packageDetails.php?pID=<?php echo $tourPackageData['id']; ?>'">View Tour</button>
                                                                            </div>
                                                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                <button class="btn package-button">Check Availability</button>
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
                        </div>
                    </div>
                    <!-- package cards -->
                </div>
            </div>
            <!-- package cards -->
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>