<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan a Tour</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h4>Plan your Tour</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <?php
                    if (isset($_SESSION["user"])) {
                        $uID = $_SESSION["user"]->id;
                    ?>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <span>Name</span>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="text" class="w-100" id="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <span>Tour Date</span>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="date" class="w-100" id="t-date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <span>Select destinations</span>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Click here to select destinations
                                                    </button>
                                                </div>
                                                <div class="col-12">
                                                    <span id="desIDList"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <center>
                                                <button class="btn btn-primary w-75">Clear</button>
                                            </center>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <center>
                                                <button class="btn btn-primary w-75" onclick="sendTourPlanningDetails();">Save changes</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <div class="col-12 col-md-8 col-lg-8 offset-md-4 offset-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span><b>Packing Items</b></span>
                                                </div>
                                                <div class="col-12">
                                                    <p>Item 1</p>
                                                    <p>Item 1</p>
                                                    <p>Item 1</p>
                                                </div>
                                                <div class="col-12">
                                                    <center>
                                                        <button class="btn btn-primary w-50">Add New</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>