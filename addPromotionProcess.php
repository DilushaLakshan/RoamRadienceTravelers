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
    $status = "no";

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
    } else {
        Database::insertUpdateDelete("INSERT INTO `promotion` (`header_text`, `details`, `discount`, `starting_date`, `end_date`, `status`)
        VALUES ('" . $name . "', '" . $disciption . "', '" . $discount . "', '" . $startDate . "', '" . $endDate . "', '" . $status . "')");

        echo "success";
    }
} else {
    echo "Something went wrong";
}
?>