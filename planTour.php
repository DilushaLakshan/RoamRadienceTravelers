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
            <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
                <div class="row">
                    <?php
                    if (isset($_SESSION["user"])) {
                        $uID = $_SESSION["user"]->id;
                    ?>
                        <div class="col-12">
                            <center>
                                <h4 class="sub-heading">Plan your Tour with RoamRadience</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <span class="descriptions">Name</span>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="text" class="w-100" id="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <span class="descriptions">Tour Date</span>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <input type="date" class="w-100" id="t-date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-4">
                                            <span class="descriptions">Select destinations</span>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="btn selection-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Click here to select destinations
                                                    </button>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <span class="descriptions" id="desIDList"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 offset-md-6 offset-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                            <button class="btn selection-button">Clear</button>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                            <button class="btn selection-button" onclick="sendTourPlanningDetails();">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <div class="col-12 col-md-8 col-lg-8 offset-md-4 offset-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="sub-heading"><b>Packing Items</b></span>
                                                </div>
                                                <div class="col-12">
                                                    <p class="descriptions" id="p-list-item"></p>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 offset-md-6 offset-lg-6">
                                                    <button class="btn selection-button">Add New</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- planned tours -->
                        <div class="col-12 mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <h4 class="sub-heading">Planned Tours</h4>
                                    </center>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-6 col-md-4 col-lg-4">
                                            <center>
                                                <span class="descriptions"><b>Date</b></span>
                                            </center>
                                        </div>
                                        <div class="col-6 col-md-4 col-lg-4">
                                            <center>
                                                <span class="descriptions"><b>Name</b></span>
                                            </center>
                                        </div>
                                        <div class="col-md-4 col-lg-4"></div>
                                    </div>
                                </div>
                                <?php
                                $planResultSet = Database::search("SELECT * FROM `self_tour_plan` WHERE `traveler_id`='" . $uID . "'");
                                $planNumRows = $planResultSet->num_rows;
                                if ($planNumRows > 0) {
                                    for ($x = 0; $x < $planNumRows; $x++) {
                                        $planData = $planResultSet->fetch_assoc();
                                ?>
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="col-6 col-md-4 col-lg-4">
                                                    <span class="descriptions"><?php echo $planData["date"]; ?></span>
                                                </div>
                                                <div class="col-6 col-md-4 col-lg-4">
                                                    <span class="descriptions"><?php echo $planData["name"]; ?></span>
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-4">
                                                    <button class="btn selection-button" data-bs-toggle="collapse" data-bs-target="#area-<?php echo $x; ?>" aria-expanded="false" aria-controls="area-<?php echo $x; ?>">
                                                        View
                                                    </button>
                                                </div>
                                                <div class="collapse mt-2" id="area-<?php echo $x; ?>">
                                                    <div class="card card-body">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <span class="descriptions"><b>Packing List</b></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="descriptions">Item 1</span><br>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <span class="descriptions"><b>Note</b></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="descriptions">Item 1</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                    <button class="btn selection-button">Edit Plan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-12 mt-2">
                                        <center>
                                            <span><i>No data available...</i></span>
                                        </center>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                </div>
                <!-- planned tours -->
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
                            <h1 class="modal-title sub-heading fs-5" id="exampleModalLabel">Select the list of destinations</h1>
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
                                                        <h6 class="card-title sub-heading"><?php echo $destinationData["name"]; ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-12">
                                            <span class="descriptions">
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
                            <button type="button" class="btn selection-button" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn selection-button" onclick="getDestinationIDs(); setPackingList();">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- destination selecttion model -->
    </div>
    <?php include 'footer.php'; ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>