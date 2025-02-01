<?php
require 'connection.php';

if (isset($_POST["jsonText"]) && !empty($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);

    $dateFrom = $dataObject->dateFrom;
    $dateTo = $dataObject->dateTo;

    if (empty($dateFrom) && empty($dateTo)) {
        echo json_encode(["error" => "Select the date range"]);

    } else {
        // fetch booking data 
        $bookingResultSet = Database::search("
        SELECT DATE_FORMAT(`date`, '%Y-%m') AS `year_month`, COUNT(*) AS `booking_count` 
        FROM `booking` 
        WHERE `date` BETWEEN '".$dateFrom."' AND '".$dateTo."' 
        GROUP BY `year_month` 
        ORDER BY `year_month`
    ");

        if ($bookingResultSet->num_rows > 0) {
            while ($row = $bookingResultSet->fetch_assoc()) {
                $monthList[] = $row['year_month']; // Format: "YYYY-MM"
                $monthlyBookingCountList[] = $row['booking_count']; // Booking count for that month
            }
        }

        // Prepare response content
        $responseContent = [
            "monthList" => $monthList,
            "monthlyBookingCountList" => $monthlyBookingCountList,
        ];

        echo json_encode($responseContent);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);

}
?>