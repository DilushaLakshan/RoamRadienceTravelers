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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_SESSION["user"])) {
                $uID = $_SESSION["user"]->id;

                include 'navbar-logged-in.php';
            } else {
                include 'navbar.php';
            }

            if (isset($_GET["pID"])) {
                $packageID = $_GET["pID"];
            ?>
                <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 main-container pack-detail-container">
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
                            <div class="col-12 mt-2 pack-details-front">
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
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="row">
                                            <!-- carousel -->
                                            <div class="col-12">
                                                <div id="carouselExampleSlidesOnly" class="carousel slide main-carousel-package" data-bs-ride="carousel">
                                                    <div class="preview-icon">
                                                        <i class="fas fa-expand" onclick="previewImage();"></i>
                                                    </div>
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <?php
                                                            $imageResultSet = Database::search("SELECT * FROM `package_photo` WHERE `tour_package_id`='" . $packageID . "' AND `type`='main'");
                                                            $imageNumRows = $imageResultSet->num_rows;
                                                            if ($imageNumRows == 1) {
                                                                $imageData = $imageResultSet->fetch_assoc();
                                                            ?>
                                                                <img id="large-image" src="resources/images/<?php echo $imageData['source']; ?>" class="d-block package-carousel-image">
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

                                    <!-- right side -->
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="card package-details-card">
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button
                                                                onclick="" class="btn"
                                                                data-bs-toggle="collapse" data-bs-target="#slot-availability" aria-expanded="false" aria-controls="slot-availability">
                                                                Check availability
                                                            </button>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <p class="p-description"><img src="resources/images/booking.svg" class="package-include-icon"><b>Easy payments </b>with smaller, interest-free instalments.</p>
                                                            <p class="p-description"><img src="resources/images/booking.svg" class="package-include-icon"><b>Book once </b>and share the cost with split payments</p>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <p class="p-description"><b>Price (per. person) - </b> $ <?php echo ($packageData["price"] . ".00"); ?></p>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <p class="p-description"><b>Customization - </b><?php echo $packageData["customize"]; ?></p>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="collapse" id="slot-availability">
                                                                <div class="card card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <span class="p-description">No. of Members</span>
                                                                        </div>
                                                                        <div class="col-12 mt-2">
                                                                            <input type="number" id="booking-members">
                                                                        </div>
                                                                        <div class="col-12 mt-3">
                                                                            <input type="date" id="checking-date" onchange="checkPackageAvailability();">
                                                                        </div>
                                                                        <div class="col-12 mt-2">
                                                                            <p class="p-description mt-3"><b>Availability : <span id="available-status"></span></b></p>
                                                                        </div>
                                                                        <div class="col-12 mt-3">
                                                                            <button
                                                                                class="btn"
                                                                                data-bs-toggle="collapse" data-bs-target="#booking-data" aria-expanded="false" aria-controls="booking-data">
                                                                                Proceed
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="collapse" id="booking-data">
                                                                <div class="card card-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-12 mt-2">
                                                                                <span class="p-description">Description</span>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <textarea name="" id="booking-des" rows="3"></textarea>
                                                                            </div>
                                                                            <button class="btn mt-3" onclick="sendBookingData(<?php echo $packageID; ?>);">Confirm Booking</button>
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
                                    <!-- right side -->
                                </div>
                            </div>

                            <!-- left side -->
                            <div class="col-12 col-md-8 col-lg-8 p-details-left">
                                <div class="row">
                                    <!-- Description Section -->
                                    <div class="col-12 mt-4" data-aos="fade-up" data-aos-duration="1000">
                                        <h5 class="sub-heading">Description</h5>
                                        <p><?php echo $packageData["description"]; ?></p>
                                    </div>

                                    <!-- destination list link -->
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="sub-heading">Destinations</h5>
                                            </div>
                                            <?php
                                            // fetch destination Ids
                                            $desIdResultSet = Database::search("SELECT * FROM `destination_has_tour_package` WHERE `tour_package_id`='" . $packageData['id'] . "'");
                                            $desIdNumRows = $desIdResultSet->num_rows;
                                            if ($desIdNumRows > 0) {
                                                for ($b = 0; $b < $desIdNumRows; $b++) {
                                                    $desIdData = $desIdResultSet->fetch_assoc();

                                                    // fetch destination data
                                                    $desResultSet = Database::search("SELECT * FROM `destination` WHERE `id`='" . $desIdData['destination_id'] . "'");
                                                    $desNumRows = $desResultSet->num_rows;
                                                    if ($desNumRows == 1) {
                                                        $desData = $desResultSet->fetch_assoc();
                                            ?>
                                                        <div class="col-12 mt-2">
                                                            <a href="destination-detail.php?desID=<?php echo $desIdData['destination_id']; ?>"><img src='resources/icons/location-icon.png' class='package-include-icon'><?php echo $desData["name"]; ?></a><br>

                                                        </div>
                                                <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <p><i>No destinations included</i></p>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- destination list link -->

                                    <!-- Traveler Comments Section -->
                                    <div class="col-12 mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
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
                                                                <?php
                                                                $commentResultSet = Database::search("SELECT * FROM `package_comment` WHERE `tour_package_id`='" . $packageID . "' ORDER BY `id` DESC LIMIT 4");
                                                                $commentNumRows = $commentResultSet->num_rows;
                                                                if ($commentNumRows > 0) {
                                                                    for ($p = 0; $p < $commentNumRows; $p++) {
                                                                        $commentData = $commentResultSet->fetch_assoc();
                                                                ?>
                                                                        <p class="p-description"><?php echo $commentData["description"]; ?></p>
                                                                        <?php
                                                                        $tResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $commentData['traveler_id'] . "'");
                                                                        $tNumRows = $tResultSet->num_rows;
                                                                        if ($tNumRows == 1) {
                                                                            $tData = $tResultSet->fetch_assoc();
                                                                        ?>
                                                                            <p class="sub-heading"><i><b><?php echo $tData["first_name"] . " " . $tData["last_name"]; ?></b></i></p>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <p>No name</p>
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
                                                            <div class="col-12 col-md-4 col-lg-4 mt-2">
                                                                <button class="btn w-100" type="button" data-bs-toggle="collapse" data-bs-target="#new-comment" aria-expanded="false" aria-controls="new-comment">
                                                                    <i>Add New Comment</i>
                                                                </button>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="new-comment">
                                                                    <div class="card card-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <i class="fa fa-star star-filled" data-index="0"></i>
                                                                                <i class="fa fa-star star-filled" data-index="1"></i>
                                                                                <i class="fa fa-star star-filled" data-index="2"></i>
                                                                                <i class="fa fa-star star-filled" data-index="3"></i>
                                                                                <i class="fa fa-star star-filled" data-index="4"></i>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div id="rating-status"></div>
                                                                            </div>
                                                                            <div class="col-12 mt-2">
                                                                                <input type="text" class="w-100" id="add-comment">
                                                                            </div>
                                                                            <div class="col-12 col-md-4 col-lg-4 mt-2">
                                                                                <button class="btn w-100" onclick="addPackageComment(<?php echo $packageID ?>);"><i>Save Changes</i></button>
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
                                    </div>

                                    <!-- Included Section -->
                                    <div class="col-12 mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
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

                                    <!-- Highlights Section -->
                                    <div class="col-12 mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
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

                            <!-- steps animation -->
                            <div class="col-12 step-animation" data-aos="fade-up">
                                <div class="row">
                                    <div class="col-12 mt-5" data-aos="fade-right">
                                        <h5>How your booking is processed?</h5>
                                    </div>
                                    <div class="col-12" data-aos="fade-left">
                                        <hr>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-6 col-md-2 col-lg-2 mt-3" data-aos="zoom-in" data-aos-delay="100">
                                                <center><img class="icon" src="resources/icons/num-one.svg" alt=""><br></center>
                                                <center>
                                                    <img class="mt-2" src="resources/icons/booking.svg" alt=""><br>
                                                </center>
                                                <center>
                                                    <span>Place your booking</span>
                                                </center>
                                            </div>
                                            <div class="col-6 col-md-2 col-lg-2 mt-3" data-aos="zoom-in" data-aos-delay="200">
                                                <center><img class="icon" src="resources/icons/num-two.svg" alt=""><br></center>
                                                <center>
                                                    <img class="mt-2" src="resources/icons/process.svg" alt=""><br>
                                                </center>
                                                <center>
                                                    <span>Agency confirmation for processing</span>
                                                </center>
                                            </div>
                                            <div class="col-6 col-md-2 col-lg-2 mt-3" data-aos="zoom-in" data-aos-delay="300">
                                                <center><img class="icon" src="resources/icons/num-three.svg" alt=""><br></center>
                                                <center>
                                                    <img class="mt-2" src="resources/icons/payment.svg" alt=""><br>
                                                </center>
                                                <center>
                                                    <span>Proceed to payment</span>
                                                </center>
                                            </div>
                                            <div class="col-6 col-md-2 col-lg-2 mt-3" data-aos="zoom-in" data-aos-delay="400">
                                                <center><img class="icon" src="resources/icons/num-four.svg" alt=""><br></center>
                                                <center>
                                                    <img class="mt-2" src="resources/icons/confirmation.svg" alt=""><br>
                                                </center>
                                                <center>
                                                    <span>Agency confirmation</span>
                                                </center>
                                            </div>
                                            <div class="col-6 col-md-2 col-lg-2 mt-3" data-aos="zoom-in" data-aos-delay="500">
                                                <center><img class="icon" src="resources/icons/num-five.svg" alt=""><br></center>
                                                <center>
                                                    <img class="mt-2" src="resources/icons/reminder.svg" alt=""><br>
                                                </center>
                                                <center>
                                                    <span>Reminder before 2 days</span>
                                                </center>
                                            </div>
                                            <div class="col-6 col-md-2 col-lg-2 mt-3" data-aos="zoom-in" data-aos-delay="600">
                                                <center><img class="icon" src="resources/icons/num-six.svg" alt=""><br></center>
                                                <center>
                                                    <img class="mt-2" src="resources/icons/map-navigation.svg" alt=""><br>
                                                </center>
                                                <center>
                                                    <span>Enjoy tour</span>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- steps animation -->

                            <!-- gallery section -->
                            <!-- <div class="col-12 mt-3 package-gallery">
                                <div class="row">
                                    <div class="col-12 mt-5">
                                        <h5>Package Gallery</h5>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <img src="resources/images/Adams Peak67176e0c76025.jpg" alt="">
                                                <span>Adams peak</span>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <img src="resources/images/Adams Peak67176e0c76025.jpg" alt="">
                                                <span>Adams peak</span>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <img src="resources/images/Adams Peak67176e0c76025.jpg" alt="">
                                                <span>Adams peak</span>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3 mt-2">
                                                <img src="resources/images/Adams Peak67176e0c76025.jpg" alt="">
                                                <span>Adams peak</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- gallery section -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            include 'footer.php';
            ?>
            <!-- Modal -->
            <div id="imagePreviewModal" class="image-preview-modal" style="display: none;">
                <div class="preview-modal-content">
                    <span class="close">&times;</span>
                    <img id="previewImage" src="" alt="Preview" />
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

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