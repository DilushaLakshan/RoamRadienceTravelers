<?php
require 'connection.php';

if (isset($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];
    $object = json_decode($jsonText);

    $vID = $object->vID;
    $vNum = $object->vNum;
    $noOfSeats = $object->noOfSeats;
    $prPerKm = $object->prPerKm;
    $prPerDay = $object->prPerDay;

    if (empty($vNum)) {
        echo "Enter the vehicle number";
    } else if (strlen($vNum) > 10 || strlen($vNum) < 6) {
        echo "Enter a valid vehicle number";
    } else if (empty($noOfSeats)) {
        echo "Enter the number of seats";
    } else if ($noOfSeats < 0 || $noOfSeats == 0 || $noOfSeats > 64) {
        echo "Check the number of seats";
    } else if (empty($prPerKm)) {
        echo "Enter the price per KM";
    } else if (empty($prPerDay)) {
        echo "Enter the price per day";
    } else {
        Database::insertUpdateDelete("UPDATE `vehicle` SET `number`='" . $vNum . "', 
        `no_of_seat`='" . $noOfSeats . "', `price_per_km`='" . $prPerKm . "', `price_per_day`='" . $prPerDay . "' 
        WHERE `id`='" . $vID . "'");

        echo "success";
    }
} else {
    echo "Something went wrong";
}
?>
