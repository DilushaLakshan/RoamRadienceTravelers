<?php
session_start();
require 'connection.php';

if (isset($_POST["packageID"]) && isset($_POST["date"])) {
    if (!empty($_POST["date"])) {
        $pID = $_POST["packageID"];
        $date = $_POST["date"];

        date_default_timezone_set('Asia/Colombo');
        $currentDate = date('Y-m-d H:i:s');

        if($date < $currentDate){
            echo "Select the correct date";
            exit();
        }

        $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $pID . "'");
        $packageNumRows = $packageResultSet->num_rows;
        if ($packageNumRows == 1) {
            $packageData = $packageResultSet->fetch_assoc();
            $availableSlots = $packageData["no_of_vehicles"];

            $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `date`='" . $date . "' AND `tour_package_id`='" . $pID . "'");
            $bookingNumRows = $bookingResultSet->num_rows;

            if ($bookingNumRows == $availableSlots) {
                echo "No";
            } else if ($bookingNumRows < $availableSlots) {
                echo "Yes";
            } else {
                echo "Yes";
            }
        }
    } else {
        echo "Select the date you want";
    }
}
?>
