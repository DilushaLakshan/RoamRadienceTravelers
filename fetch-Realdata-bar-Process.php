<?php
require 'connection.php';

if (isset($_POST["jsonText"]) && !empty($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);

    $fromDate = $dataObject->fromDate;
    $toDate = $dataObject->toDate;

    $validity = "true";
    $packageNameList = [];
    $packgeBookingCountList = [];

    // fetch all package data
    $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `validity`='" . $validity . "'");
    $packageNumRows = $packageResultSet->num_rows;
    if ($packageNumRows > 0) {
        while ($packageData = $packageResultSet->fetch_assoc()) {
            $packageNameList[] = $packageData["name"];

            // Fetch the booking count for one package
            $bookingResultSet = Database::search("SELECT COUNT(*) AS count FROM `booking` WHERE `tour_package_id`='" . $packageData['id'] . "'");
            $bookingCountData = $bookingResultSet->fetch_assoc();
            $packageBookingCountList[] = $bookingCountData['count'];
            
        }

        $responseContent = [
            "packageNameList" => $packageNameList,
            "packageBookingCountList" => $packageBookingCountList,
        ];

        echo json_encode($responseContent);

    } else {
        echo json_encode(["error" => "No data available"]);

    }
} else {
    echo json_encode(["error" => "Invalid request"]);

}
?>