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
</head>

<body>
    <div class="container-fluid back-ground main-container">
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
            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-image-contanier">
                            <section class="home">
                                <img src="resources/images/landing.png" class="video-slide banner-image" alt="hero-image">
                                <div class="content">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <h1>Wonderful <br> <span>Island</span></h1>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi eligendi harum iure culpa dignissimos quos vero atque laborum, alias assumenda possimus accusamus reprehenderit similique earum voluptatem molestias dolores voluptates delectus?</p>
                                        <a href="#">Read more</a>
                                    </div>
                                </div>
                            </section>
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
                            <div class="col-12 col-md-4 col-lg-3 mt-3">
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
                            <a href="destinations.php" class="btn text-decoration-none">See more...</a>
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

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 p-4">
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
                    <div class="col-12 col-md-6 col-lg-6 p-4">
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

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
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
                            <div class="col-12 mt-2">
                                <div class="card promotion-card">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-4 col-lg-4">
                                                    <img src="resources/images/ Jetavanaramaya66c61e61ef655.png" alt="">
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-8">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="card-title"><?php echo $promotionData["header_text"]; ?></h5>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="card-text"><b>Discount</b> - <?php echo $promotionData["discount"]; ?> off</span><br><br>
                                                            <span class="card-text"><?php echo $promotionData["details"]; ?></span>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <span class="card-text"><b>Available from </b> <?php echo $promotionData["starting_date"] ?> <b>to </b><?php echo $promotionData["end_date"]; ?></span>
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

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card dis-card2">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="card-title">Tailored Experiences</h5>
                                        </div>
                                        <div class="col-3">
                                            <img src="resources/images/experience.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    Our tours are designed to cater to your unique preferences, ensuring a personalized and
                                    immersive journey that meets your travel goals
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card dis-card2">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="card-title">24/7 Support</h5>
                                        </div>
                                        <div class="col-3">
                                            <img src="resources/images/24-7.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    We offer round-the-clock customer service to assist with any questions or issues, ensuring a
                                    worry-free experience from booking to return
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card dis-card2">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="card-title">Expert Guidance</h5>
                                        </div>
                                        <div class="col-3">
                                            <img src="resources/images/guidance.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    Benefit from our team of seasoned travel experts who provide insider tips and recommendations to
                                    help you explore each destination like a local
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card dis-card2">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="card-title">Trusted Partners</h5>
                                        </div>
                                        <div class="col-3">
                                            <img src="resources/images/patners.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    We collaborate with reputable travel partners and local guides to provide high-quality,
                                    authentic experiences in every destination
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card dis-card2">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="card-title">Best Price Gurantee</h5>
                                        </div>
                                        <div class="col-3">
                                            <img src="resources/images/money-back.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">
                                    Enjoy competitive prices on all our tours without compromising quality, so you can experience
                                    more for less
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>