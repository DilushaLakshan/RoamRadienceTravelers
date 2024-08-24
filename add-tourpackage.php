<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Package</title>
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
                            <h4>Add New Tour Package</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Name of the Package</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Price</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="price">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Description</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <textarea name="" id="description" rows="15" class="w-100"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Select the Destinations</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="#" class="btn text-decoration-none">Click here to select</a>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Launch demo modal
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <span id="desIDList"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Number of Vehicles</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="price">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Select the Vehicles</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100" id="price">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Select the Hotel</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="hotel"> Hotel 1
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="hotel"> Hotel 1
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="hotel"> Hotel 1
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="hotel"> Hotel 1
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="hotel"> Hotel 1
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="hotel"> Hotel 1
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Duration</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="duration"> 1 Day
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="duration"> 2 Days
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="duration"> 5 Days
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="duration"> 1 Week
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="duration"> 2 Weeks
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <input type="radio" name="duration"> 1 Month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Activities Type</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <div class="col-12 col-md-8 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Cultural
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Adventure
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Wildlife & Nature
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Hiking
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Beach & Coastal
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Photography
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Luxury
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <input type="checkbox" name="type"> Photography
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Total Milage</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <span>Main Image:</span>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <input class="form-control w-100" type="file" id="formFile" accept=".png, .jpg, .jpeg, .heic" onclick="">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <center><img alt="" id="" style="width: 300px; height: 400px; object-fit: cover;" class="img-fluid rounded-2" src="resources/images/default -image.svg"></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <span>Other Images:</span>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <input class="form-control w-100" type="file" id="formFile" accept=".png, .jpg, .jpeg, .heic" onclick="">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-6 col-md-3 col-lg-3">
                                                <center><img alt="" id="" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3">
                                                <center><img alt="" id="" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3">
                                                <center><img alt="" id="" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
                                            </div>
                                            <div class="col-6 col-md-3 col-lg-3">
                                                <center><img alt="" id="" style="height: 150px; object-fit: cover;" class="img-fluid rounded-2 w-100" src="resources/images/default -image.svg"></center>
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
                                <button class="w-100">Clear</button>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 mt-2">
                                <button class="w-100">ADD</button>
                            </div>
                        </div>
                    </div>

                    <!-- destination selecttion model -->
                    <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Select the list of destinations</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <?php
                                                $destinationResultSet = Database::search("SELECT * FROM `destination` ORDER BY `id` DESC");
                                                $destinationNumRows = $destinationResultSet->num_rows;
                                                if ($destinationNumRows > 0) {
                                                    for ($x = 0; $x < $destinationNumRows; $x++) {
                                                        $destinationData = $destinationResultSet->fetch_assoc();
                                                ?>
                                                        <div class="col-12 col-md-4 col-lg-4">
                                                            <div class="card w-100 border-0">
                                                                <?php
                                                                $imageResultSet = Database::search("SELECT * FROM `destination_photo` WHERE `destination_id`='" . $destinationData['id'] . "' LIMIT 1");
                                                                $imageNumRows = $imageResultSet->num_rows;
                                                                if ($imageNumRows > 0) {
                                                                    $imageData = $imageResultSet->fetch_assoc();
                                                                ?>
                                                                    <img style="height: 200px;" src="resources/images/<?php echo $imageData['src']; ?>" class="card-img-top" alt="...">

                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="resources/images/default -image.svg" class="card-img-top" alt="...">
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="card-body">
                                                                    <input type="checkbox" name="destination" value="<?php echo $destinationData['id']; ?>">
                                                                    <h6 class="card-title"><?php echo $destinationData["name"]; ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="col-12">
                                                        <span>
                                                            <i>No results found</i>
                                                        </span>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="getDestinationIDs();">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- destination selecttion model -->
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>