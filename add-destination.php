<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Place</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid back-main-container">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 add-des-content">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <center>
                                <h4 class="stf-sub-heading">Add New Destination</h4>
                                <hr>
                            </center>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <span class="stf-sub-heading">Name of the Destination:</span>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input type="text" class="input w-100" id="des-name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <span class="stf-sub-heading">Destination Categories: <br> (Select)</span>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="row">
                                        <?php
                                        $categoryResultSet = Database::search("SELECT * FROM `destination_category`");
                                        $categoryNumRows = $categoryResultSet->num_rows;
                                        if ($categoryNumRows > 0) {
                                            for ($x = 0; $x < $categoryNumRows; $x++) {
                                                $categoryData = $categoryResultSet->fetch_assoc();
                                        ?>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <input type="checkbox" name="categories[]" value="<?php echo $categoryData['id']; ?>">
                                                        </div>
                                                        <div class="col-10">
                                                            <p><?php echo $categoryData["name"]; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input type="checkbox" name="packingList[]" value="<?php echo $categoryData['id']; ?>">
                                                    </div>
                                                    <div class="col-10">
                                                        <label for="" class="stf-sub-heading"><i>No categories available</i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } ?>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <a data-bs-toggle="collapse" href="#catg-collapse" role="button" aria-expanded="false" aria-controls="catg-collapse">New category</a>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="collapse" id="catg-collapse">
                                                        <div class="card card-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <input class="w-100" type="text" id="new-catg">
                                                                </div>
                                                                <div class="col-6 offset-6 mt-2">
                                                                    <button class="btn" onclick="addCategory();">Add Category</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- packing list and items - place the relevant code in the notepad -->
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <span class="stf-sub-heading">About:</span>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <textarea name="desDetails" id="desDetails" rows="10" class="w-100"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <span class="stf-sub-heading">Thumbnail:</span>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
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
                        <div class="col-12 mt-4 mb-4">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                    <center>
                                        <button class="btn">Clear</button>
                                    </center>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                    <center>
                                        <button class="btn" onclick="sendDestinationDetails();">Add</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <!-- replace the text area by CKEDITOR -->
    <script>
        CKEDITOR.replace('desDetails');
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>