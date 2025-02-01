<?php
require 'connection.php';

if (isset($_POST["memberID"]) && isset($_POST["vehicleID"])) {
    if (!empty($_POST["memberID"]) && !empty($_POST["vehicleID"])) {
        $memberID = $_POST["memberID"];
        $vehicleID = $_POST["vehicleID"];

        if ($vehicleID == 0) {
            echo "Select the vehicle to be assigned";
        } else if ($vehicleID == -1) {
            echo "No vehicles are available";
        } else {

            // check the driver has been assigned with a vehicle
            $driverResultSet = Database::search("SELECT * FROM `driver` WHERE `staff_member_new_id`='".$memberID."'");
            $driverNumRows = $driverResultSet->num_rows;
            if($driverNumRows == 1){
                // update the existing record
                Database::insertUpdateDelete("UPDATE `driver` SET `vehicle_id`='".$vehicleID."' WHERE `staff_member_new_id`='".$memberID."'");
                echo "success";
            } else {
                // insert a new record
                Database::insertUpdateDelete("INSERT INTO `driver` (`staff_member_new_id`, `vehicle_id`) VALUES ('" . $memberID . "', '" . $vehicleID . "')");
                echo "success";
            }
        }
    } else {
        echo "Someting went wrong";
    }
} else {
    echo "Something went wrong";
}
?>