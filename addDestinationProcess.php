<?php
require 'connection.php';

if (!isset($_POST["otherDetails"])) {
    echo "Destination details are missing";
    exit;
}

$name = null;
$description = null;
$categories = null;
$itemList = null;
$imageFile = null;

$jsonText = $_POST["otherDetails"];
$otherDetailsObject = json_decode($jsonText);

// Extract details from JSON
if (isset($otherDetailsObject->name)) {
    $name = $otherDetailsObject->name;
}

if (isset($otherDetailsObject->details)) {
    $description = $otherDetailsObject->details;
}

if (isset($otherDetailsObject->catValues)) {
    foreach ($otherDetailsObject->catValues as $value) {
        $categories[] = $value;
    }
}

// packing list item ids
// if (isset($otherDetailsObject->listValues)) {
//     foreach ($otherDetailsObject->listValues as $value) {
//         $itemList[] = $value;
//     }
// }

// Validate categories and packing list from POST data if available
if (isset($_POST["catValues"]) && empty($_POST["catValues"])) {
    echo "Select the categories";
    exit;
}

// if (isset($_POST["listValues"]) && empty($_POST["listValues"])) {
//     echo "Select the list items for packing list";
//     exit;
// }

// Handle file upload
if (isset($_FILES["path"])) {
    $path = $_FILES["path"];
    $extension = pathinfo($path["name"], PATHINFO_EXTENSION);
    $allowedExtensions = ["jpg", "png", "jpeg"];
    if (in_array($extension, $allowedExtensions)) {
        $imageFile = $name . uniqid() . ".png";
        move_uploaded_file($path["tmp_name"], "resources/images/" . $imageFile);
    }
}

// Input validation
if (empty($name)) {
    echo "Please enter the name of the place/destination";
    exit;
} elseif (strlen($name) > 45) {
    echo "Name is too long. Characters must be less than 45";
    exit;
} elseif (empty($description)) {
    echo "Enter a description about the place";
    exit;
} elseif (strlen($description) > 5000) {
    echo "Description is too long";
    exit;
}

// Insert into the destination table
Database::insertUpdateDelete("INSERT INTO `destination` (`name`, `description`) VALUES ('" . $name . "', '" . $description . "')");

// Retrieve the inserted destination ID
$desResultSet = Database::search("SELECT * FROM `destination` WHERE `name`='" . $name . "'");
$desNumRows = $desResultSet->num_rows;
if ($desNumRows == 1) {
    $desData = $desResultSet->fetch_assoc();
    $destinationId = $desData['id'];

    // Insert into packing list relation
    // if (!empty($itemList)) {
    //     foreach ($itemList as $item) {
    //         Database::insertUpdateDelete("INSERT INTO `packing_list_has_destination` (`destination_id`, `packing_list_id`) VALUES ('" . $destinationId . "', '" . $item . "')");
    //     }
    // }

    // Insert into destination categories relation
    if (!empty($categories)) {
        foreach ($categories as $category) {
            Database::insertUpdateDelete("INSERT INTO `destination_has_destination_category` (`destination_id`, `destination_category_id`) VALUES ('" . $destinationId . "', '" . $category . "')");
        }
    }

    // Insert destination photo if applicable
    if (!empty($imageFile)) {
        Database::insertUpdateDelete("INSERT INTO `destination_photo` (`src`, `destination_id`) VALUES ('" . $imageFile . "', '" . $destinationId . "')");
    }

    // Insert into destination_has_packing_list relation
    // if (!empty($itemList)) {
    //     foreach ($itemList as $item) {
    //         Database::insertUpdateDelete("INSERT INTO `destination_has_packing_list` (`destination_id`, `packing_list_id`) VALUES ('" . $destinationId . "', '" . $item . "')");
    //     }
    // }

    echo "success";
} else {
    echo "Error retrieving destination ID";
}
?>