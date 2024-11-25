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
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <!-- destination cards -->
                <div class="col-12 mt-2 mb-3">
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
                                                    <a href="#" class="btn sbt-button" onclick="window.location='back-des-detail.php?desID=<?php echo $destinationData['id']; ?>'">View details</a>
                                                    <a href="#" class="btn sbt-button mt-2" onclick="window.location='update-destination.php?desID=<?php echo $destinationData['id']; ?>'">Update details</a>
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
                 <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>