<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Details</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid back-main-container">
        <div class="row">
            <?php
            if (isset($_SESSION["user"])) {
                $uID = $_SESSION["user"]->id;

                include 'back-header.php';
            }
            if (isset($_GET["pID"])) {
                $packageID = $_GET["pID"];
            ?>
                <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 view-package-back-main">
                    <div class="row">
                        <?php
                        // get the tour package details
                        $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $packageID . "'");
                        $packageNumRows = $packageResultSet->num_rows;
                        if ($packageNumRows == 1) {
                            $packageData = $packageResultSet->fetch_assoc();
                        ?>
                            <div class="col-12 mt-3">
                                <h3 class="sub-heading"><?php echo $packageData["name"]; ?></h3>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <?php
                                        $feedbackResultSet = Database::search("SELECT AVG(`rate_status`) AS `rating` FROM `package_comment` WHERE `tour_package_id` = $packageID AND `rate_status` IS NOT NULL");
                                        $feedbackNumRows = $feedbackResultSet->num_rows;
                                        if ($feedbackNumRows == 1) {
                                            $feedbackData = $feedbackResultSet->fetch_assoc();
                                            $rating = round($feedbackData['rating'], 1);
                                        } else {
                                            $rating = 0;
                                        }

                                        $filledStars = floor($rating);
                                        $halfStar = ($rating - $filledStars >= 0.5) ? 1 : 0;
                                        $emptyStars = 5 - ($filledStars + $halfStar);
                                        ?>
                                        <span class="p-description">
                                            <b><?php echo $rating; ?></b>
                                            <?php
                                            for ($i = 0; $i < $filledStars; $i++) {
                                                echo '<i class="fa-solid fa-star star-filled"></i>';
                                            }
                                            if ($halfStar) {
                                                echo '<i class="fa-solid fa-star-half-alt star-half"></i>';
                                            }
                                            for ($i = 0; $i < $emptyStars; $i++) {
                                                echo '<i class="fa-regular fa-star star-empty"></i>';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-heading">
                                            <?php
                                            // get the duration data
                                            $durationResultSet = Database::search("SELECT * FROM `duration` WHERE `id`='" . $packageData['duration_id'] . "'");
                                            $durationNumRows = $durationResultSet->num_rows;
                                            if ($durationNumRows == 1) {
                                                $durationData = $durationResultSet->fetch_assoc();
                                                echo ("<b>" . $durationData["name"] . "</b>");
                                            } else {
                                                echo ("<i>No duration data</i>");
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <!-- carousel side-->
                                    <div class="col-12 col-md-10 col-lg-10">
                                        <div class="row">
                                            <!-- carousel -->
                                            <div class="col-12">
                                                <div id="carouselExampleSlidesOnly" class="carousel slide main-carousel-package" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <?php
                                                            $imageResultSet = Database::search("SELECT * FROM `package_photo` WHERE `tour_package_id`='" . $packageID . "' AND `type`='main'");
                                                            $imageNumRows = $imageResultSet->num_rows;
                                                            if ($imageNumRows == 1) {
                                                                $imageData = $imageResultSet->fetch_assoc();
                                                            ?>
                                                                <img src="resources/images/<?php echo $imageData['source']; ?>" class="d-block package-carousel-image">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resources/images/default -image.svg" class="d-block package-carousel-image">
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- carousel -->
                                        </div>
                                    </div>
                                    <!-- carousel side-->
                                </div>
                            </div>

                            <!-- left side -->
                            <div class="col-12 col-md-10 col-lg-10 p-details-left">
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <h5 class="sub-heading">Description</h5>
                                        <p class="p-description"><?php echo $packageData["description"]; ?></p>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="sub-heading">From our travelers</h5>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-4 mt-2">
                                                <button class="btn w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-comment" aria-expanded="false" aria-controls="collapse-comment">
                                                    <i>View Comments</i>
                                                </button>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="collapse" id="collapse-comment">
                                                    <div class="card card-body mt-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="overflow-auto scrollable-area" style="max-height: 80vh;">
                                                                    <?php
                                                                    $commentResultSet = Database::search("SELECT * FROM `package_comment` WHERE `tour_package_id`='" . $packageID . "' ORDER BY `id` DESC");
                                                                    $commentNumRows = $commentResultSet->num_rows;
                                                                    if ($commentNumRows > 0) {
                                                                        for ($p = 0; $p < $commentNumRows; $p++) {
                                                                            $commentData = $commentResultSet->fetch_assoc();
                                                                    ?>
                                                                            <span class="p-description"><?php echo $commentData["description"]; ?></span>
                                                                            <br>
                                                                            <?php
                                                                            $tResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $commentData['traveler_id'] . "'");
                                                                            $tNumRows = $tResultSet->num_rows;
                                                                            if ($tNumRows == 1) {
                                                                                $tData = $tResultSet->fetch_assoc();
                                                                            ?>
                                                                                <span class="sub-heading"><i><b><?php echo $tData["first_name"] . " " . $tData["last_name"]; ?></b></i></span><br><br>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span>No name</span>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <span class="p-description"><i>No comments available...</i></span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <h5 class="sub-heading">What's included</h5>
                                        <?php
                                        // get service ids
                                        $serviceNameList = [];
                                        $servicesResultSet = Database::search("SELECT * FROM `package_includes_has_tour_package` WHERE `tour_package_id`='" . $packageID . "'");
                                        $serviceNumRows = $servicesResultSet->num_rows;

                                        if ($serviceNumRows > 0) {
                                            for ($x = 0; $x < $serviceNumRows; $x++) {
                                                $serviceData = $servicesResultSet->fetch_assoc();

                                                // get service details from the package_includes table
                                                $includeResultSet = Database::search("SELECT * FROM `package_includes` WHERE `id`='" . $serviceData['package_includes_id'] . "'");
                                                $includeNumRows = $includeResultSet->num_rows;
                                                if ($includeNumRows == 1) {
                                                    $includeData = $includeResultSet->fetch_assoc();
                                                    array_push($serviceNameList, $includeData["name"]);
                                                }
                                            }
                                        } else {
                                        ?>
                                            <p class="p-description"><i>No services available...</i></p>
                                        <?php
                                        }

                                        // Display services
                                        for ($z = 0; $z < sizeof($serviceNameList); $z++) {
                                            echo "<p><img src='resources/images/correct.svg' class='package-include-icon'><b class='p-description'>" . $serviceNameList[$z] . "</b></p>";
                                        }
                                        ?>
                                    </div>


                                    <div class="col-12 mt-4">
                                        <h5 class="sub-heading">Highlights</h5>
                                        <?php
                                        // get highlights
                                        $highlighNametList = [];
                                        $highlightResultSet = Database::search("SELECT * FROM `package_highlights` WHERE `tour_package_id`='" . $packageID . "'");
                                        $highlighNumRows = $highlightResultSet->num_rows;
                                        if ($highlighNumRows > 0) {
                                            for ($y = 0; $y < $highlighNumRows; $y++) {
                                                $highlightData = $highlightResultSet->fetch_assoc();
                                                array_push($highlighNametList, $highlightData["description"]);
                                            }
                                        } else {
                                        ?>
                                            <p class="p-description"><i>No data available...</i></p>
                                        <?php
                                        }
                                        for ($a = 0; $a < sizeof($highlighNametList); $a++) {
                                        ?>
                                            <p class="p-description"><img src="resources/images/like.svg" class="package-include-icon"><?php echo $highlighNametList[$a]; ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- left side -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            include 'back-footer.php';
            ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            var rating = 0;

            $(".fa-star").on("mouseover", function() {
                var index = $(this).data("index");
                $(".fa-star").each(function(i) {
                    if (i <= index) {
                        $(this).css("color", "orange");
                    } else {
                        $(this).css("color", "black");
                    }
                });
            });

            $(".fa-star").on("mouseleave", function() {
                $(".fa-star").css("color", "black");
            });

            $(".fa-star").on("click", function() {
                rating = $(this).data("index") + 1;
                $(".fa-star").each(function(i) {
                    if (i < rating) {
                        $(this).css("color", "orange");
                    } else {
                        $(this).css("color", "black");
                    }
                });

                $.ajax({
                    url: "ratingTest.php",
                    method: "POST",
                    data: {
                        rating: rating
                    },
                    success: function(response) {
                        $("#rating-status").html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>