<?php
session_start();
require 'connection.php';

if (!isset($_POST["tourPackageData"])) {
    echo "Tour package data is missing";
    exit;
}

$jsonText = $_POST["tourPackageData"];
$dataObject = json_decode($jsonText);

$pID = $dataObject->packageID;
$name = $dataObject->name;
$price = $dataObject->price;
$headerText = $dataObject->hText;
$description = $dataObject->description;
$destinationList = explode(",", $dataObject->destinationList);
$duration = $dataObject->duration;
$milage = $dataObject->milage;
$activityType = $dataObject->activityType;
$serviceTypes = $dataObject->serviceTypes;
$highlights = explode(",", $dataObject->highlights);
$imageFile = null;
$validity = "true";

if (isset($_FILES["mainImage"])) {
    $path = $_FILES["mainImage"];
    $extention = $path["type"];
    $allowedImageExtention = array("image/jpg", "image/png", "image/jpeg");
    if (in_array($extention, $allowedImageExtention)) {
        $imageFile = $name . uniqid() . ".png";
        move_uploaded_file($path["tmp_name"], "resources/images/" . $imageFile);
    }
}

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
    // update tour_package table
    Database::insertUpdateDelete("UPDATE `tour_package` SET `name`='" . $name . "', `price`='" . $price . "', 
    `description`='" . $description . "', `header_text`='" . $headerText . "', `total_milage`='" . $milage . "', `duration_id`='" . $duration . "' WHERE `id`='".$pID."'");

    // update the main image of the tour package
    Database::insertUpdateDelete("UPDATE `package_photo` SET `source`='".$imageFile."' WHERE `tour_package_id`='".$pID."'");

    // update activity types of the package
    Database::insertUpdateDelete("DELETE FROM `tour_package_has_activity_type` WHERE `tour_package_id`='".$pID."'");

    for($m = 0; $m < sizeof($activityType); $m++){
        Database::insertUpdateDelete("INSERT INTO `tour_package_has_activity_type` (`tour_package_id`, `activity_type_id`)
        VALUES ('".$pID."', '".$activityType[$m]."')");
    }

    // delete destinations assigned with particular tour package
    Database::insertUpdateDelete("DELETE FROM `destination_has_tour_package` WHERE `tour_package_id`='".$pID."'");

    // insert new destination list
    for($x = 0; $x < sizeof($destinationList); $x++){
        Database::insertUpdateDelete("INSERT INTO `destination_has_tour_package` (`destination_id`, `tour_package_id`) 
        VALUES ('".$destinationList[$x]."', '".$pID."')");
    }

    // delete service list assigned with tour package
    Database::insertUpdateDelete("DELETE FROM `package_includes_has_tour_package` WHERE `tour_package_id`='".$pID."'");

    // insert new service list
    for($y = 0; $y < sizeof($serviceTypes); $y++){
        Database::insertUpdateDelete("INSERT INTO `package_includes_has_tour_package` (`package_includes_id`, `tour_package_id`) VALUES ('".$serviceTypes[$y]."', '".$pID."')");
    }

    // delete highlights list
    Database::insertUpdateDelete("DELETE FROM `package_highlights` WHERE `tour_package_id`='".$pID."'");


    // insert new highlights list
    for($z = 0; $z < sizeof($highlights); $z++){
        Database::insertUpdateDelete("INSERT INTO `package_highlights` (`description`, `tour_package_id`) VALUES ('".$highlights[$z]."', '".$pID."')");
    }

    echo "Success";
}
?>
