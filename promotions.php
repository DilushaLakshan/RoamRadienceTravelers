<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Promotions</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body>
    <div class="container-fluid main-container">
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
            <!-- banner -->
            <div class="col-12 col-md-10 col-lg-10 offset-md-2 offset-lg-2 mt-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="promo-banner-image-contanier">
                            <img src="resources/images/promo-c.png" alt="hero-image">
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->

            <!-- promotion cards -->
            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 promo-list-container-front">
                <div class="row">
                    <div class="col-12">
                        <h5 class="sub-heading">Available promotions</h5>
                    </div>
                    <?php
                    $promotionResultSet = Database::search("SELECT * FROM `promotion` WHERE `status`='yes'");
                    $promotionNumRows = $promotionResultSet->num_rows;
                    if ($promotionNumRows > 0) {
                        for ($a = 0; $a < $promotionNumRows; $a++) {
                            $promotionData = $promotionResultSet->fetch_assoc();
                    ?>
                            <div class="col-12 mt-2" data-aos="fade-up"
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
            <!-- promotion cards -->
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>