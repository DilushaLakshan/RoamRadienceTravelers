<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All staff members</title>
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
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-2 mb-3 stf-member-list">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h4 class="stf-sub-heading">Staff Members</h4>
                            </center>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <!-- members main-->
                        <div class="col-12">
                            <div class="row">
                                <!-- headings -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <center>
                                                <span class="stf-sub-heading">Name</span>
                                            </center>
                                        </div>
                                        <div class="col-4">
                                            <center>
                                                <span class="stf-sub-heading">Role</span>
                                            </center>
                                        </div>
                                        <div class="col-4"></div>
                                    </div>
                                </div>
                                <!-- headings -->

                                <!-- details -->
                                <div class="col-12">
                                    <div class="scrollable-section">
                                        <div class="row">
                                            <?php
                                            $staffResultSet = Database::search("SELECT * FROM `staff_member_new`");
                                            $staffNumRows = $staffResultSet->num_rows;

                                            if ($staffNumRows > 0) {
                                                for ($x = 0; $x < $staffNumRows; $x++) {
                                                    $staffData = $staffResultSet->fetch_assoc();
                                            ?>
                                                    <div class="col-12 member-row">
                                                        <div class="col-4">
                                                            <span class="m-detail"><?php echo ($staffData["first_name"] . " " . $staffData["last_name"]); ?></span>
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="m-detail"><?php echo ($staffData["role"]); ?></span>
                                                        </div>
                                                        <div class="col-4">
                                                            <button class="btn" onclick="window.location = 'one-member.php?memberID=<?php echo $staffData['id']; ?>'">
                                                                View
                                                            </button>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- details -->
                        </div>
                    </div>
                    <!-- members main-->
                </div>
                <?php include 'back-footer.php'; ?>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>