<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Promotion</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    if (isset($_SESSION["user"]) && isset($_GET["proID"])) {
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <?php include 'back-header.php'; ?>
                        <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-2 mb-5">
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <h4 class="stf-sub-heading">Update Promotion</h4>
                                    </center>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <?php
                                $proID = $_GET["proID"];
                                $promotionResultSet = Database::search("SELECT * FROM `promotion` WHERE `id`='" . $proID . "'");
                                $promotionNumRows = $promotionResultSet->num_rows;
                                if ($promotionNumRows == 1) {
                                    $promotionData = $promotionResultSet->fetch_assoc();
                                ?>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <label class="descriptions">Header Text/ Name</label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <input type="text" class="w-100" id="name" value="<?php echo $promotionData["header_text"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <label class="descriptions">Description</label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <textarea name="description" id="description" rows="10" class="w-100"><?php echo $promotionData["header_text"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <label class="descriptions">Discount (%)</label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <input type="number" class="w-100" id="discount" value="<?php echo $promotionData["discount"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <label class="descriptions">Starting Date</label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <input type="date" class="w-100" id="s-date" value="<?php echo $promotionData["starting_date"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <label class="descriptions">End Date</label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <input type="date" class="w-100" id="end-date" value="<?php echo $promotionData["end_date"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <label class="descriptions">Status</label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="radio" class="w-100" name="status" value="enable" <?php
                                                                                                                        if ($promotionData["status"] == "yes") {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                        ?>> Enable
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="radio" class="w-100" name="status" value="disable" <?php
                                                                                                                        if ($promotionData["status"] == "no") {
                                                                                                                            echo "checked";
                                                                                                                        }
                                                                                                                        ?>> Disable
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <label class="descriptions">Image</label>
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input class="form-control w-100" type="file" id="formFile" accept=".png, .jpg, .jpeg" onclick="imagePreview();">
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <center><img alt="" id="des-image" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/default -image.svg"></center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                <button class="btn sbt-button">Clear</button>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                <button class="btn sbt-button" onclick="upadtePromotion(<?php echo $proID; ?>);">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php include 'back-footer.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>