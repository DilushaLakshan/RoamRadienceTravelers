<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries</title>
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
                <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-4 mb-4 inquiry-list-container">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h4 class="stf-sub-heading">Inquiries</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <?php
                        $inquiryResultSet = Database::search("SELECT * FROM `inquiry` WHERE `status`='0' ORDER BY `date` DESC");
                        $inquiryNumRows = $inquiryResultSet->num_rows;

                        if ($inquiryNumRows > 0) {
                            for ($x = 0; $x < $inquiryNumRows; $x++) {
                                $inquiryData = $inquiryResultSet->fetch_assoc();
                        ?>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between">
                                            <?php
                                            $userResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $inquiryData['traveler_id'] . "'");
                                            $userNumRows = $userResultSet->num_rows;

                                            if ($userNumRows == 1) {
                                                $userData = $userResultSet->fetch_assoc();
                                            ?>
                                                <span><?php echo $userData["first_name"] . " " . $userData["last_name"]; ?></span>
                                            <?php
                                            }
                                            ?>
                                            <span><i><?php echo $inquiryData["date"]; ?></i></span>
                                        </div>
                                        <div class="col-12 col-md-2 col-lg-2 mt-2 offset-md-10 offset-lg-10">
                                            <button 
                                            class="btn"
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#inq-section-<?php echo $inquiryData['id']; ?>"
                                            aria-expanded="false" aria-controls="inq-section-<?php echo $inquiryData['id']; ?>"
                                            >
                                            Reply
                                        </button>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="collapse" id="inq-section-<?php echo $inquiryData['id']; ?>">
                                                <div class="card card-body">
                                                    <div class="col-12">
                                                        <span>Message :</span><br>
                                                        <p><?php echo $inquiryData["message"]; ?></p>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <textarea name="inq-reply" id="inq-reply-<?php echo $inquiryData['id']; ?>"></textarea>
                                                    </div>
                                                    <div class="col-12 col-md-2 col-lg-2 mt-2 offset-md-10 offset-lg-10">
                                                        <button class="btn" onclick="sendInqReply(<?php echo $inquiryData['id'] ?>);">Send</button>
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
                            <div class="col-12 mt-3">
                                <center>
                                    <span><i>No data</i></span>
                                </center>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>