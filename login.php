<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid login-main">
        <div class="col-12">
            <!-- login card -->
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 offset-md-1 offset-lg-1">
                    <div class="card w-100 login">
                        <div class="card-body">
                            <div id="login-section" class="">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <center>
                                                            <p class="login-head-label"><b>Login Here</b></p>
                                                        </center>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <span class="login-label">Email</span>
                                                        <input class="login-input" type="email" id="email">
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <span class="login-label">Password</span>
                                                        <input class="login-input" type="password" id="password">
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <a href="#" class="login-link" onclick="forgotPassword();">Forgot password</a>
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <center>
                                                            <button class="btn login-button" onclick="sendLoginDetails();">Login</button>
                                                        </center>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-12">
                                                        <center>
                                                            <button class="btn login-button" onclick="window.location='user-registration.php'">Sign Up</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="email-section" class="d-none">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <center>
                                                            <p class="login-head-label"><b>Forgot Password</b></p>
                                                        </center>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <span class="login-label">Email</span>
                                                        <input class="login-input" type="email" id="email-2">
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <center>
                                                            <button class="btn login-button" onclick="checkEmail();">Next</button>
                                                        </center>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-12">
                                                        <center>
                                                            <button class="btn login-button" onclick="">Back</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="otp-section" class="d-none">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <center>
                                                            <p class="login-head-label"><b>Validate OTP</b></p>
                                                        </center>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <span class="login-label">OTP</span>
                                                        <input class="login-input" type="number" id="otp-number">
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <span><i>Enter the OTP that we have attached with the email you entered</i></span>
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <center>
                                                            <button class="btn login-button" onclick="validateOTP();">Validate</button>
                                                        </center>
                                                    </div>
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-12">
                                                        <center>
                                                            <button class="btn login-button" onclick="">Back</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="reset-password-section" class="d-none">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <center>
                                                            <p class="login-head-label"><b>Reset Password</b></p>
                                                        </center>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <span class="login-label">New Password</span>
                                                        <input class="login-input" type="password" id="password-1">
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <span class="login-label">Confirm Password</span>
                                                        <input class="login-input" type="password" id="password-2">
                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <center>
                                                            <button class="btn login-button" onclick="resetPassword();">Save Changes</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-5 offset-md-1 offset-lg-1 d-flex align-items-center d-none d-md-block">
                    <div class="welcome-text">
                        <center>
                            <h1>WELCOME to RoamRadience Travelers</h1>
                        </center>
                        <p>Break free from the ordinary and embrace the joy of seamless travel planning. With RoamRadience Travelers, the world is yours to discover—your way, your time.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>