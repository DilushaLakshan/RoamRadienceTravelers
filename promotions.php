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
            <!-- banner -->

            <!-- promotion cards -->
            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1">
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
            <!-- promotion cards -->
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>