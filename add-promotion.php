<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Promotion</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
    ?>
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid back-main-container">
                    <div class="row">
                        <?php include 'back-header.php'; ?>
                        <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-2 mb-5 new-promotion-form-container">
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <h4 class="stf-sub-heading">Add New Promotion</h4>
                                    </center>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="descriptions">Header Text/ Name</label>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="text" class="w-100" id="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="descriptions">Description</label>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <textarea name="description" id="description" rows="10" class="w-100"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="descriptions">Discount (%)</label>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="number" class="w-100" id="discount">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="descriptions">Starting Date</label>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="date" class="w-100" id="s-date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <label class="descriptions">End Date</label>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="date" class="w-100" id="end-date">
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
                                                    <input type="radio" class="w-100" name="status" value="enable"> Enable
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" class="w-100" name="status" value="disable"> Disable
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
                                            <button class="btn">Clear</button>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                            <button class="btn" onclick="newPromotion();">ADD</button>
                                        </div>
                                    </div>
                                </div>
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