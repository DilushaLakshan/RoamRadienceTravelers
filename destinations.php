<?php 
session_start();
require 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>
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

            <!-- destination cards -->
            <div class="col-12">
                <div class="row">
                    <?php
                    $destinationResultSet = Database::search("SELECT * FROM `destination` ORDER BY `id` DESC");
                    $destinationNumRows = $destinationResultSet->num_rows;
                    if ($destinationNumRows > 0) {
                        for ($x = 0; $x < $destinationNumRows; $x++) {
                            $destinationData = $destinationResultSet->fetch_assoc();
                    ?>
                            <div class="col-12 col-md-4 col-lg-3 mt-3">
                                <div class="card destination-card">
                                    <?php
                                    $imageResultSet = Database::search("SELECT * FROM `destination_photo` WHERE `destination_id`='" . $destinationData['id'] . "' LIMIT 1");
                                    $imageNumRows = $imageResultSet->num_rows;
                                    if ($imageNumRows > 0) {
                                        $imageData = $imageResultSet->fetch_assoc();
                                    ?>
                                        <img src="resources/images/<?php echo $imageData['src']; ?>" class="card-img-top destination-card-img" alt="main category">
                                        <div class="card-body">
                                            <center>
                                                <h5 class="card-title"><?php echo $destinationData["name"]; ?></h5>
                                            </center>
                                            <center>
                                                <a href="#" class="btn card-button" onclick="window.location='destination-detail.php?desID=<?php echo $destinationData['id']; ?>'">View details</a>
                                            </center>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/images/default -image.svg" class="card-img-top destination-card-img" alt="main category">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="col-12 col-md-4 col-lg-3 mt-3">
                            <center>
                                <span><i>No results available...</i></span>
                            </center>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- destination cards -->
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>