<?php
session_start();
require 'connection.php';

if (isset($_POST["date"]) && isset($_POST["noOfMembers"])) {
    if (!empty($_POST["date"]) && !empty($_POST["noOfMembers"])) {
        $noOfMembers = $_POST["noOfMembers"];
        $date = $_POST["date"];

        date_default_timezone_set('Asia/Colombo');
        $currentDate = date('Y-m-d H:i:s');

        if ($date < $currentDate) {
            echo "Select the correct date";
            exit();
        }

        // take the vehicles 
        $vehicleResultSet = Database::search("SELECT * FROM `vehicle` WHERE `no_of_seat`>='" . $noOfMembers . "'");
        $vehicleNumRows = $vehicleResultSet->num_rows;
        if ($vehicleNumRows > 0) {
            // array for booked vehicle ids
            $bookedVehicleList = [];
            // an array for storing vehicle ids that don't have bookings for relevant date
            $notBookedVehicleList = [];

            for ($p = 0; $p < $vehicleNumRows; $p++) {
                $vehicleData = $vehicleResultSet->fetch_assoc();

                $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `vehicle_id`='" . $vehicleData['id'] . "' AND `date`='" . $date . "'");
                $bookingNumRows = $bookingResultSet->num_rows;
                if ($bookingNumRows > 0) {
                    array_push($bookedVehicleList, $vehicleData["id"]);
                } else {
                    array_push($notBookedVehicleList, $vehicleData["id"]);
                }
            }

            if (sizeof($notBookedVehicleList) > 0) {
                echo "Yes";
            } else {
                echo "No";
            }
        } else {
            echo "No vehicle for " . $noOfMembers . " members";
        }
    } else {
        echo "Select the date and members you want";
    }
}
?>