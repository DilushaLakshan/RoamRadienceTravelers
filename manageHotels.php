<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hotels</title>
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
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 hotel-list-container">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h4 class="stf-sub-heading">Hotels</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <!-- members main -->
                        <div class="col-12">
                            <div class="row">
                                <!-- headings -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <center>
                                                <h6 class="stf-sub-heading">Hotel Name</h6>
                                            </center>
                                        </div>
                                        <div class="col-3">
                                            <center>
                                                <h6 class="stf-sub-heading">Address</h6>
                                            </center>
                                        </div>
                                        <div class="col-3">
                                            <center>
                                                <h6 class="stf-sub-heading">Contact</h6>
                                            </center>
                                        </div>
                                        <div class="col-3"></div>
                                    </div>
                                </div>
                                <!-- headings -->

                                <!-- details -->
                                <div class="col-12">
                                    <div class="row">
                                        <?php
                                        $hotelResultSet = Database::search("SELECT * FROM `hotel`");
                                        $hotelNumRows = $hotelResultSet->num_rows;
                                        if ($hotelNumRows > 0) {
                                            for ($x = 0; $x < $hotelNumRows; $x++) {
                                                $hotelData = $hotelResultSet->fetch_assoc();
                                        ?>
                                                <div class="col-12 mt-2">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <span><?php echo  $hotelData["name"]; ?></span>
                                                        </div>
                                                        <div class="col-3">
                                                            <span><?php echo  $hotelData["address"]; ?></span>
                                                        </div>
                                                        <div class="col-3">
                                                            <span><?php echo  $hotelData["contact"]; ?></span>
                                                        </div>
                                                        <div class="col-3">
                                                            <button class="btn" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo  $x; ?>" aria-expanded="false" aria-controls="collapse-<?php echo  $x; ?>">View</button>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="collapse" id="collapse-<?php echo  $x; ?>">
                                                                <div class="card card-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <span>Email:</span><br>
                                                                                        <span><?php echo $hotelData["email"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span>No. of Rooms:</span><br>
                                                                                        <span><?php echo $hotelData["no_of_room"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <span>Price per Room:</span><br>
                                                                                        <span><?php echo $hotelData["price"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-4 mt-2">
                                                                                        <span>Room Numbers:</span><br>
                                                                                        <?php
                                                                                        $roomResultSet = Database::search("SELECT * FROM `hotel_room` WHERE `hotel_id`='" . $hotelData['id'] . "'");
                                                                                        $roomNumRows = $roomResultSet->num_rows;
                                                                                        if ($roomNumRows > 0) {
                                                                                            for ($y = 0; $y < $roomNumRows; $y++) {
                                                                                                $roomData = $roomResultSet->fetch_assoc();
                                                                                        ?>
                                                                                                <span><?php echo $roomData["number"] . ", "; ?></span>
                                                                                            <?php
                                                                                            }
                                                                                        } else {
                                                                                            ?>
                                                                                            <span>Not Assigned</span>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-12 mt-4">
                                                                                        <div class="col-12 col-md-3 col-lg-3 offset-md-9 offset-lg-9 mt-2">
                                                                                            <button class="btn" data-bs-toggle="collapse" data-bs-target="#input-area-<?php echo $x; ?>" aria-expanded="false" aria-controls="input-area-<?php echo $x; ?>">Update</button>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- input area -->
                                                                                    <div class="col-12 mt-3">
                                                                                        <div class="collapse" id="input-area-<?php echo $x; ?>">
                                                                                            <div class="card card-body">
                                                                                                <div class="col-12 mt-2">
                                                                                                    <div class="row">
                                                                                                        <div class="col-6">
                                                                                                            <h6 class="stf-sub-heading">Hotel Name</h6>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <input type="text" id="h-name-<?php echo $hotelData['id']; ?>" class="w-100" value="<?php echo $hotelData["name"]; ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 mt-2">
                                                                                                    <div class="row">
                                                                                                        <div class="col-6">
                                                                                                            <h6 class="stf-sub-heading">Address</h6>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <input type="text" id="h-address-<?php echo $hotelData['id']; ?>" class="w-100" value="<?php echo $hotelData["address"]; ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 mt-2">
                                                                                                    <div class="row">
                                                                                                        <div class="col-6">
                                                                                                            <h6 class="stf-sub-heading">Email</h6>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <input type="email" id="h-email-<?php echo $hotelData['id']; ?>" class="w-100" value="<?php echo $hotelData["email"]; ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 mt-2">
                                                                                                    <div class="row">
                                                                                                        <div class="col-6">
                                                                                                            <h6 class="stf-sub-heading">Contact</h6>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <input type="text" id="h-contact-<?php echo $hotelData['id']; ?>" class="w-100" value="<?php echo $hotelData["contact"]; ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 mt-2">
                                                                                                    <div class="row">
                                                                                                        <div class="col-6">
                                                                                                            <h6 class="stf-sub-heading">No. of Rooms</h6>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <input type="number" id="h-rooms-<?php echo $hotelData['id']; ?>" class="w-100" value="<?php echo $hotelData["no_of_room"]; ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 mt-2">
                                                                                                    <div class="row">
                                                                                                        <div class="col-6">
                                                                                                            <h6 class="stf-sub-heading">Price per Room</h6>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <input type="number" id="h-room-price-<?php echo $hotelData['id']; ?>" class="w-100" value="<?php echo $hotelData["price"]; ?>">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 mt-2">
                                                                                                    <div class="row">
                                                                                                        <div class="col-6">
                                                                                                            <h6 class="stf-sub-heading">Room Numbers</h6>
                                                                                                        </div>
                                                                                                        <div class="col-6">
                                                                                                            <textarea name="" id="h-room-number-<?php echo $hotelData['id']; ?>"></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12 mt-4">
                                                                                                    <div class="col-12 col-md-3 col-lg-3 offset-md-9 offset-lg-9 mt-2">
                                                                                                        <button class="btn" onclick="updateHotel(<?php echo $hotelData['id']; ?>);">Save Changes</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- input area -->
                                                                            </div>
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
                                                <span><i>No results available...</i></span>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- details -->
                            </div>
                        </div>
                        <!-- members main -->
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