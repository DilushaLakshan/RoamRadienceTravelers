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
            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-3">
                <div class="card text-bg-dark banner-image-contanier">
                    <img src="resources/images/hero-image.jpg" class="card-img banner-image" alt="hero-image">
                    <div class="card-img-overlay">
                        <h3 class="card-title">Free up your mind</h3>
                        <p class="card-text">Let's travel</p>
                        <button class="btn banner-image-button">Explore Journeys</button>
                    </div>
                </div>
            </div>
            <!-- main banner -->

            <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-2">
                <h5>Popular destinations</h5>
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
                                        <a href="#" class="btn btn-primary" onclick="window.location='destination-detail.php?desID=<?php echo $destinationData['id']; ?>'">View details</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1 mt-3">
                            <center>
                                <a href="destinations.php" class="btn text-decoration-none">See more...</a>
                            </center>
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
                <h5>More to explore</h5>
            </div>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>