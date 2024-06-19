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
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card w-100 login">
                        <div class="card-body">
                            <div class="col12">
                                <div class="row">
                                    <div class="col-6">
                                        <center>
                                            <h3>Roam Radience Travelers</h3>
                                        </center>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <center>
                                                    <p class="login-head-label"><b>Login</b></p>
                                                </center>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <label class="login-label">User Name</label>
                                                <input class="login-input" type="text"  id="userName">
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label class="login-label">Password</label>
                                                <input class="login-input" type="password" id="password">
                                            </div>
                                            <div class="col-12 mt-2">
                                                <a href="#" class="login-link">Forgot password</a>
                                            </div>
                                            <div class="col-12 mt-5">
                                                <center>
                                                    <button class="btn login-button" onclick="sendLoginDetails()">Login</button>
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
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>