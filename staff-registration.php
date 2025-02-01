<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profile</title>
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
                <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2 mt-2 mb-3 stf-reg">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="stf-sub-heading">Sign Up - Staff</h4>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label>First Name</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="text" class="staff-registration-input" id="fName">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label>Last Name</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="text" class="staff-registration-input" id="lName">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="email" class="staff-registration-input" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label>Password</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="password" class="staff-registration-input" id="password">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label>Role</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <select name="role" id="role" class="staff-registration-input descriptions">
                                        <option value="not-selected" selected>Select here</option>
                                        <option value="owner">Owner</option>
                                        <option value="admin">Admin</option>
                                        <option value="driver">Driver</option>
                                        <option value="guide">Guide</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label>Contact</label>
                                </div>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="mobile" class="staff-registration-input" id="contact">
                                    <div class="row mt-5">
                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                            <button class="btn">Clear</button>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 mt-2">
                                            <button class="btn" onclick="registerStaff();">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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