<?php
require 'connection.php';

if(!isset($_POST["otherDetails"])){
    echo "Destination details are missing";
    exit;
}

$name;
$description;
$categories = null;
$itemList = null;
$imageFile = null;

$jsonText = $_POST["otherDetails"];
$otherDetailsObject = json_decode($jsonText);

$name = $otherDetailsObject->name;
$description = $otherDetailsObject->details;

foreach ($otherDetailsObject->catValues as $iterateValue) {
    $categories[] = $iterateValue;
}

foreach ($otherDetailsObject->listValues as $iterateList) {
    $itemList[] = $iterateList;
}

if (isset($_POST["catValues"])) {
    $categories = $_POST["catValues"];

    if (empty($categories)) {
        echo "Select the categories";
    }
}

if (isset($_POST["listValues"])) {
    $itemList = $_POST["listValues"];

    if (empty($itemList)) {
        echo "Select the list items for packing list";
    }
}

if (isset($_FILES["path"])) {
    $path = $_FILES["path"];
    $extention = $path["type"];
    $allowedImageExtention = array("image/jpg", "image/png", "image/jpeg");
    if (in_array($extention, $allowedImageExtention)) {
        $imageFile = $name . uniqid() . ".png";
        move_uploaded_file($path["tmp_name"], "resources/images/" . $imageFile);
    }
}

if (empty($name)) {
    echo "Please enter the name of the place/destination";
} else if (strlen($name) > 45) {
    echo "Name is too long. Characters must be less than 45";
} else if (empty($description)) {
    echo "Enter a description about the place";
} else if (strlen($description) > 5000) {
    echo "Description is too long";
} else {

    // insert data to the destination table
    Database::insertUpdateDelete("INSERT INTO `destination` (`name`, `description`) VALUES ('" . $name . "', '" . $description . "')");

    // get the id of the particular destination
    $desResultSet = Database::search("SELECT * FROM `destination` WHERE `name`='" . $name . "'");
    $desNumRows = $desResultSet->num_rows;
    if ($desNumRows == 1) {
        $desData = $desResultSet->fetch_assoc();

        for ($x = 0; $x < sizeof($itemList); $x++) {
            Database::insertUpdateDelete("INSERT INTO `packing_list_has_destination` (`destination_id`, `packing_list_id`) VALUES ('" . $desData['id'] . "', '" . $itemList[$x] . "')");
        }

        for ($y = 0; $y < sizeof($categories); $y++) {
            Database::insertUpdateDelete("INSERT INTO `destination_has_destination_category` (`destination_id`, `destination_category_id`) VALUES ('" . $desData['id'] . "', '" . $categories[$y] . "')");
        }

        Database::insertUpdateDelete("INSERT INTO `destination_photo` (`src`, `destination_id`) VALUES ('" . $imageFile . "', '" . $desData['id'] . "')");

        // insert data to the destination_has_packing_list relation
        for($p = 0; $p < sizeof($itemList); $p++){
            Database::insertUpdateDelete("INSERT INTO `destination_has_packing_list` (`destination_id`, `packing_list_id`) 
            VALUES ('".$desData['id']."', '".$itemList[$p]."')");
        }

        echo "Success";
    }
}
?>
