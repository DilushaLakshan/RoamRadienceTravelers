<?php
require 'connection.php';

if (isset($_POST["filterData"])) {
    $jsonText = $_POST["filterData"];
    $filterObject = json_decode($jsonText);

    $priceOrder = $filterObject->priceOrder;
    $durIDList = $filterObject->durIDList;
    $activityIDList = $filterObject->activityTypeArray;

    if (!empty($durIDList)) {
        $durIDString = implode(",", $durIDList);
    } else {
        $durIDString = '';
    }

    if (!empty($priceOrder) || !empty($durIDString)) {
        $query = "SELECT * FROM `tour_package`";

        if (!empty($durIDString)) {
            $query .= " WHERE `duration_id` IN ($durIDString)";
        }

        if ($priceOrder == 'ASC' || $priceOrder == 'DESC') {
            $query .= " ORDER BY `price` $priceOrder";
        }



        $tourPackageResultSet = Database::search($query);
        $tourPackageNumRows = $tourPackageResultSet->num_rows;

        echo '<div class="col-12 p-2">
                <div class="row">';

        if ($tourPackageNumRows > 0) {
            for ($x = 0; $x < $tourPackageNumRows; $x++) {
                $tourPackageData = $tourPackageResultSet->fetch_assoc();

                // Fetch package image
                $imageResultSet = Database::search("SELECT * FROM `package_photo` WHERE `tour_package_id`='" . $tourPackageData['id'] . "' AND `type`='main'");
                $imageData = ($imageResultSet->num_rows == 1) ? $imageResultSet->fetch_assoc() : null;

                echo '
                    <div class="col-12">
                        <div class="card mb-3 package-card">
                            <div class="row g-0">
                                <div class="col-md-4 p-3">
                                    <img src="resources/images/' . ($imageData ? $imageData['source'] : 'default-image.svg') . '" class="img-fluid rounded-star package-thumbnail-image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 col-md-8 col-lg-10">
                                                        <h5 class="card-title">' . $tourPackageData["name"] . '</h5>
                                                    </div>
                                                    <div class="col-12 col-md-4 col-lg-2">
                                                        <span>4.8 <i class="fa-solid fa-star"></i></span>
                                                    </div>
                                                </div>';

                // Fetch destination details
                $desNamesList = [];
                $destinationResultSet = Database::search("SELECT * FROM `destination_has_tour_package` WHERE `tour_package_id`='" . $tourPackageData['id'] . "'");
                if ($destinationResultSet->num_rows > 0) {
                    while ($destinationData = $destinationResultSet->fetch_assoc()) {
                        $desDetailsResultSet = Database::search("SELECT * FROM `destination` WHERE `id`='" . $destinationData['destination_id'] . "'");
                        if ($desDetailsResultSet->num_rows > 0) {
                            while ($desDetailsData = $desDetailsResultSet->fetch_assoc()) {
                                array_push($desNamesList, $desDetailsData["name"]);
                            }
                        }
                    }
                }

                echo '<span>Destinations: ' . (!empty($desNamesList) ? implode(', ', $desNamesList) : '<i>No data</i>') . '</span>';

                // Fetch duration
                $durationResultSet = Database::search("SELECT * FROM `duration` WHERE `id`='" . $tourPackageData['duration_id'] . "'");
                $durationData = ($durationResultSet->num_rows == 1) ? $durationResultSet->fetch_assoc() : null;

                echo '
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <span>Duration - ' . ($durationData ? $durationData["name"] : '<i>No data</i>') . '</span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <span>Price - ' . $tourPackageData["price"] . ' LKR</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span>Operating Languages - English/ Sinhala</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                        <button class="btn package-button" onclick="window.location = \'packageDetails.php?pID=' . $tourPackageData['id'] . '\'">View Tour</button>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-6 mt-2">
                                                        <button class="btn package-button">Check Availability</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo '
                <div class="col-12">
                    <center><span><i>No results found...</i></span></center>
                </div>';
        }

        echo '</div></div>';
    }
}
?>