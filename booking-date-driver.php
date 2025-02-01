<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    // Get the user ID from the session
    $uId = $_SESSION["user"]->id;
    $bookingDateList = [];

    // check the assign status with vehicle
    $driverResultSet = Database::search("SELECT * FROM `driver` WHERE `staff_member_new_id`='" . $uId . "'");
    $driverNumRows = $driverResultSet->num_rows;

    if ($driverNumRows > 0) {
        for ($a = 0; $a < $driverNumRows; $a++) {
            $driverData = $driverResultSet->fetch_assoc();

            // fetch the booking dates for particular vehicle
            $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `vehicle_id`='" . $driverData['vehicle_id'] . "'");
            $bookingNumRows = $bookingResultSet->num_rows;

            if ($bookingNumRows > 0) {
                for ($b = 0; $b < $bookingNumRows; $b++) {
                    $bookingData = $bookingResultSet->fetch_assoc();

                    $bookingDateList[] = [
                        "title" => "Booking",
                        "start" => $bookingData["date"]
                    ];
                }
            }
        }
    } else {
        echo "You are not assigned with a vehicle";
    }

    // Return the booking dates in JSON format
    header("Content-Type: application/json");
    echo json_encode($bookingDateList);
} else {
    // Handle case where user is not logged in
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["error" => "Unauthorized access"]);
}
?>