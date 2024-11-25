<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Promotions</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-2 mb-5 p-3">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h4 class="stf-sub-heading">Manage Promotions</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            $promotionResultSet = Database::search("SELECT * FROM `promotion`");
                            $promotionNumRows = $promotionResultSet->num_rows;
                            if ($promotionNumRows > 0) {
                                for ($x = 0; $x < $promotionNumRows; $x++) {
                                    $promotionData = $promotionResultSet->fetch_assoc();
                            ?>
                                    <div class="col-12 mt-2">
                                        <div class="card promotion-card">
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-md-4 col-lg-4">
                                                            <img src="resources/images/Ultimate Sri Lankan Adventure Escape67064dbaad245.png" alt="">
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
                                                                    <span class="card-text"><b>Available from </b> <?php echo $promotionData["starting_date"]; ?> <b>to </b> <?php echo $promotionData["end_date"]; ?></span>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <span class="card-text"><b>Valid Status </b> <?php if ($promotionData["status"] == "yes") {
                                                                                                                        echo "Enabled";
                                                                                                                    } else {
                                                                                                                        echo "Disabled";
                                                                                                                    } ?></span>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <span class="card-text"><b>Assign Status </b> Yes/ No</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn sbt-button" onclick="window.location='update-promotion.php?proID=<?php echo $promotionData['id']; ?>'">Update</button>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn sbt-button" onclick="upadtePromotionStatus(<?php echo $promotionData['id']; ?>, 'yes');">Enable</button>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn sbt-button" onclick="upadtePromotionStatus(<?php echo $promotionData['id']; ?>, 'no');">Disable</button>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                                            <button class="btn sbt-button">Assign</button>
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
                                <?php
                                }
                            } else {
                                ?>
                                <div class="col-12 mt-2">
                                    <center>
                                        <span><i>No available promotions</i></span>
                                    </center>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>