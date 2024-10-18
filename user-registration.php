<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
                            <h4 class="sub-heading">Sign Up - Traveler</h4>
                        </center>
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
                                <input type="text" class="registration-input" id="fName">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Last Name</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="registration-input" id="lName">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Email</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="email" class="registration-input" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Password</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="password" class="registration-input" id="password">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>House No</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="registration-input" id="house">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Street 1</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="registration-input" id="st1">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Street 2</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="text" class="registration-input" id="st2">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <label>Contact</label>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <input type="mobile" class="registration-input" id="contact">
                                <div class="row mt-5">
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn registration-button">Clear</button>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                        <button class="btn registration-button" onclick="registerUser()">Sign Up</button>
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