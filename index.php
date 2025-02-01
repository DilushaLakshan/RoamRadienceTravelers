<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body>
    <div class="container-fluid back-ground main-container">
        <div class="row">
            <?php
            $uID = 0;
            if (isset($_SESSION["user"])) {
                $uID = $_SESSION["user"]->id;
                include 'navbar-logged-in.php';
            } else {
                $uID = 0;
                include 'navbar.php';
            }
            ?>
            <!-- main banner -->
            <div class="col-12 col-md-10 col-lg-10 offset-md21 offset-lg-2 mt-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="promo-banner-image-contanier">
                            <img src="resources/images/main-c.jpg" alt="hero-image">
                        </div>
                    </div>
                </div>
            </div>
            <!-- main banner -->

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
                <h5 class="sub-heading">Popular destinations</h5>
            </div>

            <!-- category cards -->
            <div class="col-12 col-lg-10 offset-md-1 destination-background">
                <div class="row">
                    <?php
                    $destinationResultSet = Database::search("SELECT * FROM `destination` ORDER BY `id` DESC LIMIT 12");
                    $destinationNumRows = $destinationResultSet->num_rows;
                    if ($destinationNumRows > 0) {
                        for ($x = 0; $x < $destinationNumRows; $x++) {
                            $destinationData = $destinationResultSet->fetch_assoc();
                    ?>
                            <div class="col-12 col-md-4 col-lg-3 mt-3"
                                data-aos="fade-up"
                                data-aos-delay="<?php echo $x * 100; ?>">
                                <div class="card category-card">
                                    <?php
                                    $imageResultSet = Database::search("SELECT * FROM `destination_photo` WHERE `destination_id`='" . $destinationData['id'] . "' LIMIT 1");
                                    $imageNumRows = $imageResultSet->num_rows;
                                    if ($imageNumRows == 1) {
                                        $imageData = $imageResultSet->fetch_assoc();
                                    ?>
                                        <img src="resources/images/<?php echo $imageData['src']; ?>" class="card-img-top category-card-img" alt="main category">

                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/images/default -image.svg" class="card-img-top category-card-img" alt="main category">

                                    <?php
                                    }
                                    ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $destinationData["name"]; ?></h5>
                                        <button href="#" class="btn card-button" onclick="window.location='destination-detail.php?desID=<?php echo $destinationData['id']; ?>'">View details</button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-3">
                            <a href="destinations.php" class="btn see-more-link">See more...</a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-12 col-md-4 col-lg-3 mt-3">
                            <center>
                                <span><i>No results found...</i></span>
                            </center>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- category cards -->

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
                <h5 class="sub-heading">More to explore</h5>
            </div>

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2 mission-vision">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 p-4" data-aos="zoom-in">
                        <div class="card dis-card1">
                            <div class="card-body">
                                <h5 class="card-title">Mission</h5>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-9 col-lg-9">
                                            <p class="card-text">
                                                “At RoamRadience, our mission is to create exceptional travel
                                                experiences for our customers by offering seamless booking,
                                                personalized itineraries, and outstanding customer service. We
                                                are dedicated to providing high-quality tours that highlight the
                                                beauty and diversity of destinations, ensuring a memorable journey
                                                every time.”
                                            </p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <img src="resources/images/misson-icon.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 p-4" data-aos="zoom-in" data-aos-delay="500">
                        <div class="card dis-card1">
                            <div class="card-body">
                                <h5 class="card-title">Vision</h5>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-9 col-lg-9">
                                            <p class="card-text">
                                                Our vision is to become the leading tour booking platform,
                                                connecting travelers with extraordinary destinations while
                                                promoting sustainable tourism. We aim to inspire exploration
                                                and create lasting memories through unique, curated travel
                                                experiences.”
                                            </p>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3">
                                            <img src="resources/images/vision-icon.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2 promo-section">
                <div class="row">
                    <div class="col-12 mt-2">
                        <h5 class="sub-heading">Available promotions</h5>
                    </div>
                    <?php
                    $promotionResultSet = Database::search("SELECT * FROM `promotion` WHERE `status`='yes'");
                    $promotionNumRows = $promotionResultSet->num_rows;
                    if ($promotionNumRows > 0) {
                        for ($a = 0; $a < $promotionNumRows; $a++) {
                            $promotionData = $promotionResultSet->fetch_assoc();
                    ?>
                            <div class="col-12 mt-2"
                                data-aos="fade-up"
                                data-aos-delay="<?php echo $a * 300; ?>">
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
                                                            <h5 class="card-title"><?php echo $promotionData["header_text"]; ?></h5>
                                                        </div>
                                                        <div class="col-12">
                                                            <p class="card-text"><b>Discount</b> - <?php echo $promotionData["discount"]; ?>% off</p>
                                                            <p class="card-text"><?php echo $promotionData["details"]; ?></p>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <p class="card-text"><b>Available from - </b> <?php echo $promotionData["starting_date"] ?> <b>to - </b><?php echo $promotionData["end_date"]; ?></p>
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
                                <span><i>No promotions available</i></span>
                            </center>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
                <h5 class="sub-heading">Why choose us</h5>
            </div>

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2 specialities-section">
                <div class="row">
                    <?php
                    $specialities = [
                        ['title' => 'Tailored Experiences', 'icon' => 'experience.svg', 'description' => 'Our tours are designed to cater to your unique preferences, ensuring a personalized and immersive journey that meets your travel goals'],
                        ['title' => '24/7 Support', 'icon' => '24-7.svg', 'description' => 'We offer round-the-clock customer service to assist with any questions or issues, ensuring a worry-free experience from booking to return'],
                        ['title' => 'Expert Guidance', 'icon' => 'guidance.svg', 'description' => 'Benefit from our team of seasoned travel experts who provide insider tips and recommendations to help you explore each destination like a local'],
                        ['title' => 'Trusted Partners', 'icon' => 'patners.svg', 'description' => 'We collaborate with reputable travel partners and local guides to provide high-quality, authentic experiences in every destination'],
                        ['title' => 'Best Price Guarantee', 'icon' => 'money-back.svg', 'description' => 'Enjoy competitive prices on all our tours without compromising quality, so you can experience more for less'],
                    ];

                    foreach ($specialities as $index => $speciality) {
                    ?>
                        <div class="col-12 col-md-4 col-lg-4"
                            data-aos="fade-up"
                            data-aos-delay="<?php echo $index * 300; ?>">
                            <div class="card dis-card2">
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <h5 class="card-title"><?php echo $speciality['title']; ?></h5>
                                            </div>
                                            <div class="col-3">
                                                <img src="resources/images/<?php echo $speciality['icon']; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="card-text">
                                        <?php echo $speciality['description']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-4">
                <h5 class="sub-heading">Client Reviews</h5>
            </div>

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2 review-area">
                <div class="row">
                    <!-- Client Review Card -->
                    <div class="col-12 col-md-8 col-lg-6"
                        data-aos="fade-left"
                        data-aos-duration="1000">
                        <div class="card client-review-card">
                            <div class="card-body">
                                <?php
                                $reviewResultSet = Database::search("SELECT * FROM `review` ORDER BY `date` DESC LIMIT 1");
                                $reviewNumRows = $reviewResultSet->num_rows;
                                if ($reviewNumRows == 1) {
                                    $reviewData = $reviewResultSet->fetch_assoc();

                                    $travResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $reviewData['traveler_id'] . "'");
                                    $travNumRows = $travResultSet->num_rows;
                                    if ($travNumRows == 1) {
                                        $travData = $travResultSet->fetch_assoc();
                                ?>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h5 class="card-title"><?php echo $travData["first_name"] . " " . $travData["last_name"]; ?></h5>
                                                    <span class="card-text"><i>From <?php echo $reviewData["country"]; ?></i></span><br>
                                                    <span class="card-text"><i><?php echo $reviewData["date"]; ?></i></span>
                                                </div>
                                                <div class="col-3">
                                                    <img src="" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <p class="card-text"><?php echo $reviewData["message"]; ?></p>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-12">
                                        <p><i>No reviews available...</i></p>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Social Review Section -->
                    <div class="col-12 col-md-4 col-lg-6">
                        <div class="row">
                            <!-- Facebook -->
                            <div class="col-12 col-md-4 col-lg-4 mt-2"
                                data-aos="zoom-in"
                                data-aos-delay="200">
                                <center>
                                    <i class="fab fa-facebook social-icon facebook"></i><br>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i><br>
                                    <span>Facebook Reviews</span>
                                </center>
                            </div>

                            <!-- Google -->
                            <div class="col-12 col-md-4 col-lg-4 mt-2"
                                data-aos="zoom-in"
                                data-aos-delay="400">
                                <center>
                                    <i class="fab fa-google social-icon google"></i><br>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i><br>
                                    <span>Google Reviews</span>
                                </center>
                            </div>

                            <!-- Instagram -->
                            <div class="col-12 col-md-4 col-lg-4 mt-2"
                                data-aos="zoom-in"
                                data-aos-delay="600">
                                <center>
                                    <i class="fab fa-instagram social-icon instagram"></i><br>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i>
                                    <i class="fa-solid fa-star star-filled mt-3"></i><br>
                                    <span>Instagram Reviews</span>
                                </center>
                            </div>

                            <!-- Button -->
                            <div class="col-12 mt-4"
                                data-aos="zoom-in"
                                data-aos-delay="800">
                                <center>
                                    <button class="btn me-2">View more reviews</button>
                                    <button
                                        class="btn"
                                        onclick="validateSessionObject(<?php echo $uID; ?>)">Share experience</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-4">
            <h5 class="sub-heading">Licence and Agreements</h5>
        </div>

        <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card licence-card">
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4" data-aos="zoom-in" data-aos-duration="1000">
                                    <img src="resources/images/certificate.jpeg" alt="" class="img-fluid">
                                </div>
                                <div class="col-12 col-md-4 col-lg-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                                    <img src="resources/images/certificate2.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-12 col-md-4 col-lg-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                                    <img src="resources/images/certificate3.webp" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- client-review modal -->
        <div class="modal fade rvw-modal" id="client-rvw-model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Share your experience</h1>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <p>Country : </p>
                                </div>
                                <div class="col-12">
                                    <input type="text" id="country">
                                </div>
                                <div class="col-12">
                                    <p>Message : </p>
                                </div>
                                <div class="col-12">
                                    <textarea name="review-msg" id="review-msg"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitClientRvw(<?php echo $uID; ?>);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- client-review modal -->
        <?php include 'footer.php'; ?>
    </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>