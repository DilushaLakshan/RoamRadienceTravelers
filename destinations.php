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

            <div class="col-12">
                <div class="row">
                    <!-- filter area -->
                    <div class="col-12 col-md-4 col-lg-4 p-md-3 p-lg-5 filter-area">
                        <div class="overflow-auto scrollable-area" style="max-height: 80vh;">
                            <div class="col-12 p-4">
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <h3 class="filter-heading  m-2"><img src="resources/images/filter-icon.svg" alt="" class="filter-icon" /> Apply Filters</h3>
                                        </center>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <span class="sub-heading">Categories</span>
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            $categoryResultSet = Database::search("SELECT * FROM `destination_category`");
                                            $categoryNumRows = $categoryResultSet->num_rows;
                                            if ($categoryNumRows > 0) {
                                                for ($a = 0; $a < $categoryNumRows; $a++) {
                                                    $categoryData = $categoryResultSet->fetch_assoc();
                                            ?>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <input type="checkbox" name="category" value="<?php echo $categoryData['id']; ?>">
                                                            </div>
                                                            <div class="col-10">
                                                                <label for="<?php echo $categoryData['name']; ?>"><?php echo $categoryData['name']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-12 mt-2">
                                                    <center>
                                                        <span><i>No results available</i></span>
                                                    </center>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 mt-3 p-5">
                                                <button class="btn package-button" onclick="applyDestinationFilter();">Apply Filters</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- filter area -->

                    <!-- destination cards -->
                    <div class="col-12 col-md-8 col-lg-8 p-md-3 p-lg-5">
                        <div class="overflow-auto scrollable-area" style="max-height: 80vh;" id="destination-area">
                            <div class="row">
                                <div class="col-12 p-2">
                                    <div class="row">
                                        <?php
                                        $destinationResultSet = Database::search("SELECT * FROM `destination` ORDER BY `id` DESC");
                                        $destinationNumRows = $destinationResultSet->num_rows;
                                        if ($destinationNumRows > 0) {
                                            for ($x = 0; $x < $destinationNumRows; $x++) {
                                                $destinationData = $destinationResultSet->fetch_assoc();
                                        ?>
                                                <div class="col-6 col-md-4 col-lg-4 mt-3">
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
                                            <div class="col-12 col-md-4 col-lg-4 mt-3">
                                                <center>
                                                    <span><i>No results available...</i></span>
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
                    <!-- destination cards -->
                </div>
            </div>
            <?php include 'footer.php'; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>