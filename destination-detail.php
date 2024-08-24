<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination Name</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'navbar.php'; ?>

            <!-- carousel -->
            <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-3">
                <div class="row">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <?php
                        $desID = $_GET["desID"];

                        $imageResultSet = Database::search("SELECT * FROM `destination_photo` WHERE `destination_id`='" . $desID . "' LIMIT 1");
                        $imageNumRows = $imageResultSet->num_rows;
                        if ($imageNumRows > 0) {
                            $imageData = $imageResultSet->fetch_assoc();
                        ?>
                            <div class="carousel-inner main-image">
                                <div class="carousel-item active">
                                    <img src="resources/images/<?php echo $imageData['src']; ?>" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        <?php
                        } else {
                        ?>
                            <div class="carousel-inner main-image">
                                <div class="carousel-item active">
                                    <img src="resources/images/default -image.svg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- carousel -->

            <?php
            $destinationResultSet = Database::search("SELECT * FROM `destination` WHERE `id`='" . $desID . "'");
            $destinationNumRows = $destinationResultSet->num_rows;
            if ($destinationNumRows > 0) {
                $destinationData = $destinationResultSet->fetch_assoc();
            ?>
                <!-- heading -->
                <div class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3 mt-3">
                    <center>
                        <h4><?php echo $destinationData["name"]; ?></h4>
                    </center>
                    <hr>
                </div>
                <!-- heading -->

                <!-- description -->
                <div class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3 mt-3">
                    <center>
                        <p><?php echo $destinationData["description"]; ?></p>
                    </center>
                    <h6>Best Time to Visit - </h6>
                    <p>May to August</p>
                    <hr>
                </div>
                <!-- description -->
            <?php
            }
            ?>

            <!-- comments -->
            <div class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3 mb-3">
                <h6>Comments</h6>
                <center>
                    <button class="comment-button mt-3">Add a New Comment</button>
                </center>
            </div>
            <!-- comments -->
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>