<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="resources/images/roamRadience-head-logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item navbar-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item navbar-item">
                        <a class="nav-link" href="destinations.php">Destinations</a>
                    </li>
                    <li class="nav-item navbar-item">
                        <a class="nav-link" href="packages.php">Packages</a>
                    </li>
                    <li class="nav-item navbar-item">
                        <a class="nav-link" href="promotions.php">Promotions</a>
                    </li>
                    <!-- <li class="nav-item navbar-item">
                        <a class="nav-link" href="planTour.php">Plan</a>
                    </li> -->
                </ul>
                <div class="dropdown ms-lg-3">
                    <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="btn dropdown-item" onclick="window.location='traveler-profile.php'">Profile</button></li>
                        <li><button class="btn dropdown-item" onclick="window.location='logoutProcess.php'">Logout</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>



</html>