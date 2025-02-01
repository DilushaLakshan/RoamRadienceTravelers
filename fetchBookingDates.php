<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    // Get the user ID from the session
    $uId = $_SESSION["user"]->id;
    $bookingDateList = [];

    $bookingResultSet = Database::search("SELECT * FROM `booking`");
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

    // Return the booking dates in JSON format
    header("Content-Type: application/json");
    echo json_encode($bookingDateList);
} else {
    // Handle case where user is not logged in
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["error" => "Unauthorized access"]);
}
