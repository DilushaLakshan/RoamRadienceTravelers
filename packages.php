<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour packages</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'navbar.php';  ?>

            <!-- main banner -->
            <div class="col-12 mt-3">
                <div class="card text-bg-dark banner-image-contanier">
                    <img src="resources/images/hero-image.jpg" class="card-img banner-image" alt="...">
                    <div class="card-img-overlay">
                        <h3 class="card-title">Free up your mind</h3>
                        <p class="card-text">Let's travel</p>
                        <button class="btn banner-image-button">Explore Journeys</button>
                    </div>
                </div>
            </div>
            <!-- main banner -->

            <!-- package cards -->
            <div class="col-12">
                <div class="row">
                    <!-- filter area -->
                    <div class="col-12 col-md-4 col-lg-4 p-md-3 p-lg-5">
                        <div class="row p-3">
                            <div class="col-12">
                                <center>
                                    <h3 class="filter-heading  m-2"><img src="resources/images/filter-icon.svg" alt="" class="filter-icon" /> Apply Filters</h3>
                                </center>
                            </div>
                            <div class="col-12">
                                <span>Price</span>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="radio" name="sort-price">
                                            </div>
                                            <div class="col-10">
                                                <label for="">Low to high</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="radio" name="sort-price">
                                            </div>
                                            <div class="col-10">
                                                <label for="">High to low</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <span>Duration</span>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">5 Days</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">10 Days</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">20 Days</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">1 Month</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">45 Days</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">2 Months</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <span>Activities</span>
                                <hr>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">Hiking</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">Visiting</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">Historical places</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">Water</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">Offroad</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-10">
                                                <label for="">Forests</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- filter area -->

                    <!-- package cards -->
                    <dic class="col-12 col-md-8 col-lg-8 p-md-3 p-lg-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-3 package-card">
                                    <div class="row g-0">
                                        <div class="col-md-4 p-3">
                                            <img src="resources/images/login.jpg" class="img-fluid rounded-star package-thumnail-image" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-md-8 col-lg-10">
                                                                <h5 class="card-title">Name of the tour package</h5>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-2">
                                                                <span>4.8 <i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <span>Duration - 10 days</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <span>Price - 45000.00 LKR</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <button class="btn package-button">View Tour</button>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <button class="btn package-button">Book Now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card mb-3 package-card">
                                    <div class="row g-0">
                                        <div class="col-md-4 p-3">
                                            <img src="resources/images/login.jpg" class="img-fluid rounded-star package-thumnail-image" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-md-8 col-lg-10">
                                                                <h5 class="card-title">Name of the tour package</h5>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-2">
                                                                <span>4.8 <i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <span>Duration - 10 days</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <span>Price - 45000.00 LKR</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <button class="btn package-button">View Tour</button>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <button class="btn package-button">Book Now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card mb-3 package-card">
                                    <div class="row g-0">
                                        <div class="col-md-4 p-3">
                                            <img src="resources/images/login.jpg" class="img-fluid rounded-star package-thumnail-image" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-md-8 col-lg-10">
                                                                <h5 class="card-title">Name of the tour package</h5>
                                                            </div>
                                                            <div class="col-12 col-md-4 col-lg-2">
                                                                <span>4.8 <i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <span>Duration - 10 days</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <span>Price - 45000.00 LKR</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <button class="btn package-button">View Tour</button>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-6">
                                                                <button class="btn package-button">Book Now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </dic>
                    <!-- package cards -->
                </div>
            </div>
            <!-- package cards -->
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>