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
<div class="container-fluid registration-main">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8 offset-md-2 offset-lg-2">
                <div class="row">
                    <div class="col-12">
                        <center>
                            <h4 class="stf-sub-heading">Sign Up - Staff</h4>
                        </center>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">First Name</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="staff-registration-input" id="fName">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Last Name</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="staff-registration-input" id="lName">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Email</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="email" class="staff-registration-input" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Password</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="password" class="staff-registration-input" id="password">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Role</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <select name="role" id="role" class="staff-registration-input descriptions" >
                                    <option value="not-selected" selected>Select here</option>
                                    <option value="owner">Owner</option>
                                    <option value="driver">Driver</option>
                                    <option value="guide">Guide</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label class="descriptions">Contact</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="mobile" class="staff-registration-input" id="contact">
                                <div class="row mt-5">
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn sbt-button">Clear</button>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn sbt-button" onclick="registerStaff();">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>
</body>
</html>