<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Member</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            $memberID = $_GET["memberID"];

            $memberResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `id`='" . $memberID . "'");
            $memberNumRows = $memberResultSet->num_rows;
            if ($memberNumRows == 1) {
                $memberData = $memberResultSet->fetch_assoc();
            ?>
                <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2 mt-5">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <span>Name:</span>
                                </div>
                                <div class="col-6">
                                    <span><?php echo ($memberData["first_name"] . " " . $memberData["last_name"]); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <span>Role:</span>
                                </div>
                                <div class="col-6">
                                    <span><?php echo ($memberData["role"]); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <span>Email:</span>
                                </div>
                                <div class="col-6">
                                    <span><?php echo ($memberData["email"]); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <span>Password:</span>
                                </div>
                                <div class="col-6">
                                    <span><?php echo ($memberData["password"]); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <span>Contact:</span>
                                </div>
                                <div class="col-6">
                                    <span><?php echo ($memberData["contact"]); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <button class="btn btn-outline-info w-100">Block User</button>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <button class="btn btn-outline-info w-100">Update User</button>
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

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>