<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Hotel</title>
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
                <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-2 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h4 class="stf-sub-heading">Add New Hotel</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="descriptions">Hotel Name</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="text" class="w-100" id="h-name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="descriptions">Address</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="text" class="w-100" id="h-address">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="descriptions">Email</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="email" class="w-100" id="h-email">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="descriptions">Contact</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="text" class="w-100" id="h-contact">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="descriptions">No. of Rooms</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="number" class="w-100" id="h-rooms">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="descriptions">Rooms Numbers</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" class="w-100" class="w-100" id="room-numbers" placeholder="Use ',' to seperate room numbers">
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="radio" name="type" value="a/c"> A/C
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" name="type" value="n-a/c"> Non A/C
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="descriptions">Price Per. Room (LKR)</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="number" class="w-100" id="h-price">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                    <button class="btn sbt-button">Clear</button>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                    <button class="btn sbt-button" onclick="addHotel();">Add</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>