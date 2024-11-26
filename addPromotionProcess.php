<?php
require 'connection.php';

if (isset($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);

    $name = $dataObject->name;
    $disciption = $dataObject->discription;
    $discount = $dataObject->discount;
    $startDate = $dataObject->startDate;
    $endDate = $dataObject->endDate;
    $imageFile = null;
    $status = "no";

    if (isset($_FILES["imagePath"])) {
        $path = $_FILES["imagePath"];
        $extention = $path["type"];
        $allowedImageExtention = array("image/jpg", "image/png", "image/jpeg");
        if (in_array($extention, $allowedImageExtention)) {
            $imageFile = $name . uniqid() . ".png";
            move_uploaded_file($path["tmp_name"], "resources/images/" . $imageFile);
        }
    }

    date_default_timezone_set('Asia/Colombo');
    $currentDate = date('Y-m-d H:i:s');

    if (empty($name)) {
        echo "Enter the name or header text";
    } else if (strlen($name) > 100) {
        echo "Header Text is too long";
    } else if (empty($disciption)) {
        echo "Enter the discription";
    } else if (strlen($disciption) > 5000) {
        echo "Discription is too long";
    } else if (empty($discount)) {
        echo "Enter the discount";
    } else if (empty($startDate)) {
        echo "Select the starting date";
    } else if ($startDate < $currentDate) {
        echo "Select the correct stating date";
    } else if (empty($endDate)) {
        echo "Select the end date";
    } else if ($endDate < $currentDate || $endDate <= $startDate) {
        echo "Select the correct ending date";
    } else if (empty($imageFile)) {
        echo "Select an image";
    } else if (strlen($imageFile) > 10000) {
        echo "Selected image source is too long";
    } else {
        Database::insertUpdateDelete("INSERT INTO `promotion` (`header_text`, `details`, `discount`, `starting_date`, `end_date`, `status`, `image_src`)
        VALUES ('" . $name . "', '" . $disciption . "', '" . $discount . "', '" . $startDate . "', '" . $endDate . "', '" . $status . "', '".$imageFile."')");

        echo "success";
    }
} else {
    echo "Something went wrong";
}
?>