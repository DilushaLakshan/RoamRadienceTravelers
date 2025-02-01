<?php
session_start();
require 'connection.php';
?>
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
    <?php
    if (isset($_SESSION["user"])) {
        $uID = $_SESSION["user"]->id;
    ?>
        <div class="container-fluid back-main-container">
            <div class="row">
                <?php
                include 'back-header.php';

                $memberID = $_GET["memberID"];

                $memberResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `id`='" . $memberID . "'");
                $memberNumRows = $memberResultSet->num_rows;
                if ($memberNumRows == 1) {
                    $memberData = $memberResultSet->fetch_assoc();
                ?>
                    <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-4 mb-5 one-member-detail">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="descriptions">First Name:</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="f-name" class="staff-registration-input" value="<?php echo ($memberData["first_name"]); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="descriptions">Last Name:</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="l-name" class="staff-registration-input" value="<?php echo ($memberData["last_name"]); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="descriptions">Role:</span>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12 col-md-8 col-lg-8">
                                            <select name="role" id="role" class="staff-registration-input descriptions">
                                                <option value="not-selected">Select here</option>
                                                <option value="owner" <?php if ($memberData["role"] == "owner") {
                                                                            echo "selected";
                                                                        } ?>>Owner</option>
                                                <option value="driver" <?php if ($memberData["role"] == "driver") {
                                                                            echo "selected";
                                                                        } ?>>Driver</option>
                                                <option value="guide" <?php if ($memberData["role"] == "guide") {
                                                                            echo "selected";
                                                                        } ?>>Guide</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span class="descriptions">Email:</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="email" id="email" class="staff-registration-input" value="<?php echo ($memberData["email"]); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span lass="descriptions">Password:</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="password" id="password" class="staff-registration-input" value="<?php echo ($memberData["password"]); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <span lass="descriptions">Contact:</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="contact" class="staff-registration-input" value="<?php echo ($memberData["contact"]); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn" onclick="blockUnblockUser(<?php echo $memberID; ?>, 2);">Block User</button>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn" onclick="blockUnblockUser(<?php echo $memberID; ?>, 1);">Unblock User</button>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn" onclick="updateStaffMember(<?php echo $memberID; ?>);">Update User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }

                include 'back-footer.php';
                ?>
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