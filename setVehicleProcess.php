<?php
session_start();
require 'connection.php';

if (isset($_POST["jsonText"])) {
    if (!empty($_POST["jsonText"])) {
        $jsonText = $_POST["jsonText"];
        $dataObject = json_decode($jsonText);

        $bookingId = $dataObject->bookingId;
        $vehicleId = $dataObject->assignedVehicleId;

        // update the vehicle ID of booking table
        Database::insertUpdateDelete("UPDATE `booking` SET `vehicle_id`='".$vehicleId."' WHERE `id`='".$bookingId."'");

        echo "success";
    } else {
        echo "Invalid request";
    }
} else {
    echo "Something went wrong...";
}
?>