<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Destnation</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                include 'back-header.php';

                if (isset($_GET["desID"])) {
                    $desID = $_GET["desID"];

                    $desResultSet = Database::search("SELECT * FROM `destination` WHERE `id`='" . $desID . "'");
                    $desNumRows = $desResultSet->num_rows;
                    if ($desNumRows == 1) {
                        $desData = $desResultSet->fetch_assoc();
                ?>
                        <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-2 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <h4 class="stf-sub-heading">Update Destination - <?php echo $desData["name"]; ?></h4>
                                    </center>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="descriptions">Destination Name</label>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="text" class="w-100" id="name" value="<?php echo $desData["name"]; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="descriptions">Description</label>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <textarea name="description" id="description" rows="10" class="w-100"><?php echo $desData["description"]; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <span class="descriptions">Main Image:</span>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8 mt-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <input class="form-control w-100" type="file" id="main-image" accept=".png, .jpg, .jpeg" onclick="mainImagePreview();">
                                                </div>
                                                <?php
                                                $imageResultSet = Database::search("SELECT * FROM `destination_photo` WHERE `destination_id`='" . $desID . "'");
                                                $imageNumRows = $imageResultSet->num_rows;
                                                if ($imageNumRows > 0) {
                                                    for ($x = 0; $x < $imageNumRows; $x++) {
                                                        $imageData = $imageResultSet->fetch_assoc();
                                                ?>
                                                        <div class="col-12 mt-2">
                                                            <center><img alt="" id="m-image" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/<?php echo $imageData["src"]; ?>"></center>
                                                        </div>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="col-12 mt-2">
                                                        <center><img alt="" id="m-image" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/default -image.svg"></center>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-6 col-md-2 col-lg-2 offset-6 offset-md-10 offset-lg-10 mt-3">
                                            <a href="ownerHome.php" class="descriptions">back to home</a>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                            <button class="btn sbt-button">Clear</button>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                            <button class="btn sbt-button" onclick="updateDestination(<?php echo $desID; ?>);">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }

                include 'back-footer.php';
                ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

    <!-- replace the text area by CKEDITOR -->
    <script>
        CKEDITOR.replace('description');
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>