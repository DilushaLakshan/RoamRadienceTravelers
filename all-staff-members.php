<?php require 'connection.php'; ?>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
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
                                <div class="row">
                                    <?php
                                    $staffResultSet = Database::search("SELECT * FROM `staff_member_new`");
                                    $staffNumRows = $staffResultSet->num_rows;
                                    if ($staffNumRows > 0) {
                                        for ($x = 0; $x < $staffNumRows; $x++) {
                                            $staffData = $staffResultSet->fetch_assoc();
                                    ?>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <span class="descriptions"><?php echo ($staffData["first_name"] . " " . $staffData["last_name"]); ?></span>
                                                    </div>
                                                    <div class="col-4">
                                                        <span lass="descriptions"><?php echo ($staffData["role"]); ?></span>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="btn sbt-button" onclick="window.location = 'one-member.php?memberID=<?php echo $staffData['id']; ?>'">
                                                            View
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- details -->
                    </div>
                </div>
                <!-- members main-->
            </div>

        </div>
    </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>