<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    // Get the user ID from the session
    $uId = $_SESSION["user"]->id;
    $bookingDateList = [];

    // check assign status with tour package
    $guideResultSet = Database::search("SELECT * FROM `guide` WHERE `staff_member_new_id`='" . $uId . "'");
    $guideNumRows = $guideResultSet->num_rows;

    if ($guideNumRows == 1) {
        $guideData = $guideResultSet->fetch_assoc();

        // fetch booking dates for relevant tour package
        $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `tour_package_id`='" . $guideData['tour_package_id'] . "'");
        $bookingNumRows = $bookingResultSet->num_rows;

        if ($bookingNumRows > 0) {
            for ($a = 0; $a < $bookingNumRows; $a++) {
                $bookingData = $bookingResultSet->fetch_assoc();

                $bookingDateList[] = [
                    "title" => "Booking",
                    "start" => $bookingData["date"]
                ];
            }
        }
    } else {
        echo "You have not been assigned with tour package";
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