<?php
require 'connection.php';

if(!isset($_POST["vehicleData"])){
    echo "Vehicle data is missing";
    exit;
}

$jsonText = $_POST["vehicleData"];
$dataObject = json_decode($jsonText);

$vehicleNum = $dataObject->vehicleNum;
$numOfSeats = $dataObject->numOfSeats;
$prPerKm = $dataObject->prPerKm;
$prPerDay = $dataObject->prPerDay;
$vType = $dataObject->vType;

if (empty($vehicleNum)) {
    echo "Enter the vehicle number";
} else if (strlen($vehicleNum) > 10 || strlen($vehicleNum) < 6) {
    echo "Enter a valid vehicle number";
} else if (empty($numOfSeats)) {
    echo "Enter the number of seats";
} else if ($numOfSeats < 0 || $numOfSeats == 0 || $numOfSeats > 64) {
    echo "Check the number of seats";
} else if (empty($prPerKm)) {
    echo "Enter the price per KM";
} else if (empty($prPerDay)) {
    echo "Enter the price per day";
} else if(empty($vType)){
    echo "Please select the vehicle type";
} else {
    Database::insertUpdateDelete("INSERT INTO `vehicle` (`number`,`no_of_seat`,`price_per_km`,`price_per_day`,`type`) 
    VALUES ('" . $vehicleNum . "', '" . $numOfSeats . "', '" . $prPerKm . "', '" . $prPerDay . "','".$vType."')");

    echo "Success";
}
?>