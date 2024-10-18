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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
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
                                <label class="descriptions">Vecicle Number</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="v-number">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">No. of Seats</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="number" class="w-100" id="v-seats">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Price per KM</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="number" class="w-100" id="price-km">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Price per day</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="number" class="w-100" id="price-day">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Vehicle Type</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <input type="radio" name="v-type" value="car"> Car
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <input type="radio" name="v-type" value="van"> Van
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <input type="radio" name="v-type" value="bus"> Bus
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <input type="radio" name="v-type" value="suv"> SUV
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <input type="radio" name="v-type" value="jeep"> Jeep
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <button class="btn sbt-button">Clear</button>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <button class="btn sbt-button" onclick="addVehicle();">ADD</button>
                            </div>
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