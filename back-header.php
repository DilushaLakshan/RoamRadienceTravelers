<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $uId = $_SESSION["user"]->id;

        $userResultSet = Database::search("SELECT * FROM `staff_member_new` WHERE `id`='" . $uId . "'");
        $userNumRows = $userResultSet->num_rows;
        if ($userNumRows == 1) {
            $userData = $userResultSet->fetch_assoc();
            $userRole = $userData["role"];

            if ($userRole == "owner") {
    ?>
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="d-flex justify-content-between p-2 back-navbar-content">
                            <a class="ms-3 mt-1" href="#">RoamRadience</a>
                            <div class="d-flex align-items-center ms-auto">
                                <button class="btn me-2" id="notificationButton" onclick="window.location='inquiries.php'">
                                    <i class="fa fa-bell"></i>
                                </button>
                                <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Expand</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-4  back-navbar-navigation-area">
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <h1></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="logoutProcess.php">Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="ownerHome.php">Dashboard</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="staff-registration.php">Add New User</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="all-staff-members.php">View Users</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-destination.php">Add New Destination</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="back-destinations.php">Manage Destinations</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="addVehicle.php">Add New Vehicle</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="manageVehicles.php">Manage Vehicles</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-hotel.php">Add New Hotel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="manageHotels.php">Manage Hotels</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-tourpackage.php">Add New Tour Package</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="stf-tPackages.php">Manage Tour Packages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-promotion.php">Add New Promotion</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="manage-promotion.php">Manage Promotions</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="bookings.php">Manage Bookings</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="reports.php">View Reports</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="calander-view.php">Calander - Booking dates</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($userRole == "admin") {
            ?>
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="d-flex justify-content-between p-2 back-navbar-content">
                            <a class="ms-3 mt-1" href="#">RoamRadience</a>
                            <div class="d-flex align-items-center ms-auto">
                                <button class="btn me-2" id="notificationButton">
                                    <i class="fa fa-bell"></i>
                                </button>
                                <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Expand</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-4 back-navbar-navigation-area">
                        <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <h1></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="logoutProcess.php">Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="admin-home.php">Dashboard</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="staff-registration.php">Add New User</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="all-staff-members.php">View Users</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-destination.php">Add New Destination</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="back-destinations.php">Manage Destinations</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="addVehicle.php">Add New Vehicle</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="manageVehicles.php">Manage Vehicles</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-hotel.php">Add New Hotel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="manageHotels.php">Manage Hotels</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-tourpackage.php">Add New Tour Package</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="stf-tPackages.php">Manage Tour Packages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="add-promotion.php">Add New Promotion</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="manage-promotion.php">Manage Promotions</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="driverWithVehicle.php">Driver + Vehicle</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card back-card">
                                            <div class="card-body">
                                                <a class="back-link" href="guideWithPackage.php">Guide + Package</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($userRole == "driver") {
            ?>
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="d-flex justify-content-between p-2 back-navbar-content">
                            <a class="ms-3 mt-1" href="#">RoamRadience</a>
                            <a class="right-button" href="logoutProcess.php">Logout</a>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($userResultSet == "guide") {
            ?>
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="d-flex justify-content-between p-2 back-navbar-content">
                            <a class="ms-3 mt-1" href="#">RoamRadience</a>
                            <a class="right-button" href="logoutProcess.php">Logout</a>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="d-flex justify-content-between p-2 back-navbar-content">
                            <a class="ms-3 mt-1" href="#">RoamRadience</a>
                            <a class="right-button" href="logoutProcess.php">Logout</a>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>