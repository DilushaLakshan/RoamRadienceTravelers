<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Vehicle</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid back-main-container">
            <div class="row">
                <?php include 'back-header.php'; ?>
                <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-4 mb-4 add-vehicle-form">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h4 class="stf-sub-heading">Add New Vehicle</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="att-name">Vecicle Number</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="text" class="w-100" id="v-number">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="att-name">No. of Seats</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="number" class="w-100" id="v-seats">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="att-name">Price per KM</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="number" class="w-100" id="price-km">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="att-name">Price per day</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="number" class="w-100" id="price-day">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label class="att-name">Vehicle Type</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="radio" name="v-type" value="car"> Car
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="v-type" value="van"> Van
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="v-type" value="bus"> Bus
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="v-type" value="suv"> SUV
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" name="v-type" value="jeep"> Jeep
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
                                    <button class="btn" onclick="addVehicle();">ADD</button>
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