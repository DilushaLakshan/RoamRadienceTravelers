<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
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
            <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-5">
                <div class="row">
                    <?php
                    if (isset($_SESSION["user"])) {
                        $uID = $_SESSION["user"]->id;

                        $travelerResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $uID . "'");
                        $travelerNumRows = $travelerResultSet->num_rows;
                        if ($travelerNumRows == 1) {
                            $travelerData = $travelerResultSet->fetch_assoc();
                    ?>
                            <div class="col-12 mt-2">
                                <center>
                                    <h3 class="sub-heading">Welcome back, <?php echo ($travelerData["first_name"]); ?></h3>
                                </center>
                            </div>

                            <!-- profile data -->
                            <div class="col-12 mt-3 profile-section-container">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">First Name:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['first_name']; ?>" id="fName">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Last Name:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['last_name']; ?>" id="lName">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Email:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['email']; ?>" id="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Password:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="password" class="w-100" value="<?php echo $travelerData['password']; ?>" id="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Contact:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['contact']; ?>" id="contact">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Home No.:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['house_no']; ?>" id="hNo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Street 1:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['street_1']; ?>" id="street1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="descriptions">Street 2:</span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <input type="text" class="w-100" value="<?php echo $travelerData['street_2']; ?>" id="street2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4 offset-md-8 offset-lg-8 mt-3">
                                                <button class="btn" onclick="updateTraveler();">Save changes</button>
                                            </div>
                                            <!-- <div class="col-12 col-md-6 col-lg-6 mt-3">
                                                <button class="btn" onclick="">Deactivate Account</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile data -->

                            <div class="col-12 mt-3">
                                <hr>
                            </div>

                            <!-- booking histrory -->

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <h4 class="sub-heading">Booking history</h4>
                                        </center>
                                    </div>
                                    <?php
                                    $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `traveler_id`='" . $uID . "'");
                                    $bookingNumRows = $bookingResultSet->num_rows;
                                    if ($bookingNumRows > 0) {
                                    ?>
                                        <div class="col-12 mt-2 booking-history-heading">
                                            <div class="row">
                                                <div class="col-6">
                                                    <span>Date</span>
                                                </div>
                                                <div class="col-6">
                                                    <span>Status</span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        for ($x = 0; $x < $bookingNumRows; $x++) {
                                            $bookingData = $bookingResultSet->fetch_assoc();
                                        ?>
                                            <div class="col-12 mt-2  booking-history-section">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-6 col-md-4 col-lg-4">
                                                                <p><?php echo $bookingData["date"]; ?></p>
                                                            </div>
                                                            <div class="col-6 col-md-4 col-lg-4">
                                                                <p><?php
                                                                    if ($bookingData["status_id"] == 1) {
                                                                        echo "Pending";
                                                                    } else if ($bookingData["status_id"] == 2) {
                                                                        echo "Confirmed";
                                                                    } else if ($bookingData["status_id"] == 3) {
                                                                        echo "Rejected";
                                                                    } else if ($bookingData["status_id"] == 4) {
                                                                        echo "Proceed to Payment";
                                                                    } else {
                                                                        echo "No data";
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-4">
                                                                <center>
                                                                    <button class="btn" data-bs-toggle="collapse" data-bs-target="#area-<?php echo $x; ?>" aria-expanded="false" aria-controls="area-<?php echo $x; ?>">
                                                                        View Details
                                                                    </button>
                                                                </center>
                                                            </div>
                                                            <!-- collapse content -->
                                                            <div class="col-12 mt-2 mb-2">
                                                                <div class="collapse" id="area-<?php echo $x; ?>">
                                                                    <div class="card card-body">
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <?php
                                                                                $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $bookingData['tour_package_id'] . "'");
                                                                                $packageNumRows = $packageResultSet->num_rows;
                                                                                if ($packageNumRows == 1) {
                                                                                    $packageData = $packageResultSet->fetch_assoc();
                                                                                ?>
                                                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <span>Price</span>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <p><?php echo $packageData["price"] * $bookingData["no_of_members"]; ?>LKR</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <span>Milage</span>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <p><?php echo $packageData["total_milage"]; ?> KM</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <span>Duration</span>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <?php
                                                                                                $durationResultSet = Database::search("SELECT * FROM `duration` WHERE `id`='" . $packageData['duration_id'] . "'");
                                                                                                $durationNumRows = $durationResultSet->num_rows;
                                                                                                if ($durationNumRows == 1) {
                                                                                                    $durationData = $durationResultSet->fetch_assoc();
                                                                                                ?>
                                                                                                    <p><?php echo $durationData["name"]; ?></p>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <span>Date</span>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <p><?php echo $bookingData["date"]; ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <span>Special Discounts</span>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <?php
                                                                                                if (!empty($bookingData["special_discount"])) {
                                                                                                ?>
                                                                                                    <p><?php echo $bookingData["special_discount"]; ?></p>
                                                                                                <?php
                                                                                                } else {
                                                                                                ?>
                                                                                                    <p><i>No</i></p>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <span>Promotion Discounts</span>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <span>-</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                                                            <a href="checkoutProcess.php" class="btn btn-primary">Make payment</a>
                                                                                    </div> -->
                                                                                    <div class="col-12 d-flex justify-content-end mt-3 profile-payment">
                                                                                        <button id="payhere-payment" class="btn"
                                                                                            onclick="makePayment(<?php echo $packageData['id'] . ',' . $bookingData['id']; ?>);"
                                                                                            <?php if ($bookingData["status_id"] != 4) {
                                                                                                echo 'style="display: none;"';
                                                                                            } ?>>
                                                                                            Make Payment
                                                                                        </button>
                                                                                    </div>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- collapse content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        ?>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-12 mt-3">
                                            <span class="descriptions">
                                                <i>No matching records...</i>
                                            </span>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- booking histrory -->

                            <div class="col-12">
                                <hr>
                            </div>

                            <!-- inquiry section -->

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <h4 class="sub-heading">Inquiries</h4>
                                        </center>
                                    </div>
                                    <div class="col-12 customer-inquiry-section">
                                        <div class="row">
                                            <?php
                                            $inquiryResultSet = Database::search("SELECT * FROM `inquiry` WHERE `traveler_id`='" . $uID . "'");
                                            $inquiryNumRows = $inquiryResultSet->num_rows;
                                            if ($inquiryNumRows > 0) {
                                                for ($m = 0; $m < $inquiryNumRows; $m++) {
                                                    $inquirtyData = $inquiryResultSet->fetch_assoc();
                                            ?>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 col-lg-4">
                                                                <p><?php echo $inquirtyData["date"]; ?></p>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-4">
                                                                <p><?php echo $inquirtyData["message"]; ?></p>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-4">
                                                                <button
                                                                    class="btn"
                                                                    data-bs-toggle="collapse" data-bs-target="#reply-collapse-<?php echo $m; ?>"
                                                                    aria-expanded="false" aria-controls="reply-collapse-<?php echo $m; ?>">
                                                                    View reply
                                                                </button>
                                                            </div>
                                                            <div class="col-12 mt-2">
                                                                <div class="collapse" id="reply-collapse-<?php echo $m; ?>">
                                                                    <div class="card card-body">
                                                                        <?php
                                                                        $replyResultSet = Database::search("SELECT * FROM `inquiry_reply` WHERE `inquiry_id`='" . $inquirtyData['id'] . "'");
                                                                        $replyNumRows = $replyResultSet->num_rows;
                                                                        if ($replyNumRows > 0) {
                                                                            for ($n = 0; $n < $replyNumRows; $n++) {
                                                                                $replyData = $replyResultSet->fetch_assoc();
                                                                        ?>
                                                                                <p><?php echo $replyData["response_message"]; ?></p>
                                                                            <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <p><i>No replies yet...</i></p>
                                                                        <?php
                                                                        }
                                                                        ?>
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
                                                        <p><i>No previous data available...</i></p>
                                                    </center>
                                                </div>
                                            <?php
                                            } ?>
                                            <div class="col-12 col-md-3 col-lg-3 mt-3" data-bs-toggle="collapse" data-bs-target="#inquiry-input-area" aria-expanded="false" aria-controls="inquiry-input-area">
                                                <button class="btn">Send Inquiry</button>
                                            </div>
                                            <div class="col-12 col-md-9 col-lg-9 mt-2">
                                                <div class="collapse" id="inquiry-input-area">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <textarea name="inquiry-message" id="inquiry-message" rows="10"></textarea>
                                                        </div>
                                                        <div class="col-12 col-md-3 col-lg-3 offset-md-9">
                                                            <button class="btn" onclick="sendInquiry();">Send message</button>
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
                            <!-- inquiry section -->
                    <?php

                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            include 'footer.php';
            ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>