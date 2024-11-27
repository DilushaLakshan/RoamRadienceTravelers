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
                                                <a href="#" class="login-link">Forgot password</a>
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