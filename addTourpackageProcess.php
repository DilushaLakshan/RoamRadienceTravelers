<?php
require 'connection.php';

if (!isset($_POST["tourPackageData"])) {
    echo "Tour package data is missing";
    exit;
}

$jsonText = $_POST["tourPackageData"];
$dataObject = json_decode($jsonText);

$name = $dataObject->name;
$price = $dataObject->price;
$headerText = $dataObject->hText;
$description = $dataObject->description;
$destinationList = explode(",", $dataObject->destinationList);
$noOfVehicles = $dataObject->nuOfVehicles;
$vehicleList = explode(",", $dataObject->vehicleList);
$hotelList = explode(",", $dataObject->hotelList);
$duration = $dataObject->duration;
$milage = $dataObject->milage;
$activityType = $dataObject->activityType;
$serviceTypes = $dataObject->serviceTypes;
$highlights = explode(",", $dataObject->highlights);
$imageFile = null;
$mainImageType = null;
$validity = "true";

if (empty($name)) {
    echo "Please enter a name for the package";
} else if (strlen($name) > 45) {
    echo "Name is too long";
} else if (empty($price)) {
    echo "Enter the package price";
} else if (empty($headerText)) {
    echo "Enter the Header Text";
} else if (strlen($headerText) > 200) {
    echo "header Text is too long";
} else if (empty($description)) {
    echo "Enter the details of the package";
} else if (strlen($description) > 10000) {
    echo "Description is too long";
} else if (empty($destinationList)) {
    echo "Please select the destinations";
} else if (empty($noOfVehicles)) {
    echo "Please enter the number of vehicles alligned for the package";
} else if (empty($vehicleList)) {
    echo "Plese select the vehicles";
} else if ($noOfVehicles != sizeof($vehicleList)) {
    echo "Please check the number of vehicles and selected vehicles";
} else if (empty($hotelList)) {
    echo "Please select the hotels";
} else if (empty($duration)) {
    echo "Select the duration of the tour";
} else if (empty($milage)) {
    echo "Please enter the milage of the tour";
} else if (empty($activityType)) {
    echo "Select the activity type(s)";
} else if (empty($serviceTypes)) {
    echo "Select the services provide for the tour package";
} else if (empty($highlights)) {
    echo "Enter the package highlights";
} else {
    // get vehicle results from the vehicle table according to the vehicle id
    for ($x = 0; $x < sizeof($vehicleList); $x++) {
        $vehicleResultSet = Database::search("SELECT * FROM `vehicle` WHERE `id`='" . $vehicleList[$x] . "'");
        $vehicleNumRows = $vehicleResultSet->num_rows;
        if ($vehicleNumRows == 1) {
            $vehicleData = $vehicleResultSet->fetch_assoc();

            // check the vehicles are assigned for any tour package
            $vtResultSet = Database::search("SELECT * FROM `vehicle_has_tour_package` WHERE `vehicle_id`='" . $vehicleList[$x] . "'");
            $vtNumRows = $vtResultSet->num_rows;
            if ($vtNumRows > 0) {
                echo $vehicleData["number"] . " has already assigned with some package";
                exit();
            }
        } else {
            echo "No results found for vehicle";
            exit();
        }
    }

    // insert data to the tour_package table
    Database::insertUpdateDelete("INSERT INTO `tour_package` (`name`, `price`, `header_text`, `description`, `duration_id`, `total_milage`, `no_of_vehicles`, `validity`) 
    VALUES ('" . $name . "', '" . $price . "', '" . $headerText . "', '" . $description . "', '" . $duration . "', '" . $milage . "', '" . $noOfVehicles . "', '" . $validity . "')");

    // get lastly inserted record
    $tpResultSet = Database::search("SELECT * FROM `tour_package` ORDER BY `id` DESC LIMIT 1");
    $tpNumRows = $tpResultSet->num_rows;
    if ($tpNumRows == 1) {
        $tpData = $tpResultSet->fetch_assoc();

        // insert data to the package_photo table
        if (isset($_FILES["mainImage"])) {
            $path = $_FILES["mainImage"];
            $extention = $path["type"];
            $allowedImageExtention = array("image/jpg", "image/png", "image/jpeg");
            if (in_array($extention, $allowedImageExtention)) {
                $imageFile = $name . uniqid() . ".png";
                move_uploaded_file($path["tmp_name"], "resources/images/" . $imageFile);
                $mainImageType = "main";
            }
        }

        Database::insertUpdateDelete("INSERT INTO `package_photo` (`source`, `tour_package_id`, `type`)
        VALUES ('" . $imageFile . "', '" . $tpData['id'] . "', '" . $mainImageType . "')");

        // insert data to the destination_has_tour_package
        for ($m = 0; $m < sizeof($destinationList); $m++) {
            Database::insertUpdateDelete("INSERT INTO `destination_has_tour_package` (`destination_id`, `tour_package_id`)
            VALUES ('" . $destinationList[$m] . "', '" . $tpData['id'] . "')");
        }

        // insert data to the tour_package_has_activity_type table
        for ($p = 0; $p < sizeof($activityType); $p++) {
            Database::insertUpdateDelete("INSERT INTO `tour_package_has_activity_type` (`tour_package_id`, `activity_type_id`)
            VALUES ('" . $tpData['id'] . "', '" . $activityType[$p] . "')");
        }

        // insert data to the vehicle_has_tour_package table
        for ($y = 0; $y < sizeof($vehicleList); $y++) {
            Database::insertUpdateDelete("INSERT INTO `vehicle_has_tour_package` (`vehicle_id`, `tour_package_id`) 
            VALUES ('" . $vehicleList[$y] . "', '" . $tpData['id'] . "')");
        }

        // insert data to the hotel_has_tour_package tabel
        for ($z = 0; $z < sizeof($hotelList); $z++) {
            Database::insertUpdateDelete("INSERT INTO `hotel_has_tour_package` (`hotel_id`, `tour_package_id`) 
            VALUES ('" . $hotelList[$z] . "', '" . $tpData['id'] . "')");
        }

        // insert data to the package_includes_has_tour_package table
        for ($e = 0; $e < sizeof($serviceTypes); $e++) {
            Database::insertUpdateDelete("INSERT INTO `package_includes_has_tour_package` (`package_includes_id`, `tour_package_id`) 
            VALUES ('" . $serviceTypes[$e] . "', '" . $tpData['id'] . "')");
        }

        // insert data to the package_highlights table
        for ($f = 0; $f < sizeof($highlights); $f++) {
            Database::insertUpdateDelete("INSERT INTO `package_highlights` (`description`, `tour_package_id`) 
            VALUES ('" . $highlights[$f] . "', '" . $tpData['id'] . "')");
        }

        // insert data to the expence table - get vehicle data
        for ($a = 0; $a < sizeof($vehicleList); $a++) {
            $vehicleResultSet2 = Database::search("SELECT * FROM `vehicle` WHERE `id`='" . $vehicleList[$a] . "'");
            $vehicleNumRows2 = $vehicleResultSet2->num_rows;
            if ($vehicleNumRows2 == 1) {
                $vehicleData2 = $vehicleResultSet2->fetch_assoc();

                switch ($duration) {
                    case "1":
                        $durationNum = 1;
                        break;
                    case "2":
                        $durationNum = 2;
                        break;
                    case "3":
                        $durationNum = 5;
                        break;
                    case "4":
                        $durationNum = 7;
                        break;
                    case "5":
                        $durationNum = 14;
                        break;
                    case "6":
                        $durationNum = 30;
                        break;
                    default:
                        $durationNum = 2;
                }
                $vehicleExpenses = ($vehicleData2["price_per_km"] * $milage) + ($vehicleData2["price_per_day"] * $durationNum);
                $otherExpenses = 50000;

                // insert data to the expence table - get hotel data
                for ($b = 0; $b < sizeof($hotelList); $b++) {
                    $hotelResultSet2 = Database::search("SELECT * FROM `hotel` WHERE `id`='" . $hotelList[$b] . "'");
                    $hotelNumRows2 = $hotelResultSet2->num_rows;
                    if ($hotelNumRows2 == 1) {
                        $hotelData2 = $hotelResultSet2->fetch_assoc();
                        $hotelExpenses = $hotelData2["no_of_room"] * $hotelData2["price"] * $durationNum;

                        // insert all data - expense table
                        Database::insertUpdateDelete("INSERT INTO `expense` (`hotel_id`, `tour_package_id`, `vehicle_id`, `vehicle_expence`, `other_expence`, `hotel_expence`)
                        VALUES ('" . $hotelList[$b] . "', '" . $tpData['id'] . "', '" . $vehicleList[$a] . "', '" . $vehicleExpenses . "', '" . $otherExpenses . "', '" . $hotelExpenses . "')");

                        echo "Success";
                    }
                }
            }
        }
    }
}
?>
