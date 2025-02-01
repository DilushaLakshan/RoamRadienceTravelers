<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = [];

    // Fetch all bookings
    $bookingResultSet = Database::search("SELECT * FROM `booking`");
    $bookingNumRows = $bookingResultSet->num_rows;

    if ($bookingNumRows > 0) {
        $groupedData = [];

        for ($a = 0; $a < $bookingNumRows; $a++) {
            $bookingData = $bookingResultSet->fetch_assoc();

            // Extract year and month from booking date
            $date = new DateTime($bookingData['date']); // Assuming `date` column exists in the `booking` table
            $yearMonth = $date->format('Y-m'); // Grouping key: "YYYY-MM"

            if (!isset($groupedData[$yearMonth])) {
                $groupedData[$yearMonth] = ['income' => 0, 'expense' => 0];
            }

            // Fetch related payment data
            $paymentResultSet = Database::search("SELECT * FROM `payment` WHERE `booking_id`='" . $bookingData['id'] . "'");
            if ($paymentResultSet->num_rows > 0) {
                $paymentData = $paymentResultSet->fetch_assoc();
                $groupedData[$yearMonth]['income'] += $paymentData['amount'];
            }

            // Fetch related expense data
            $expenseResultSet = Database::search("SELECT * FROM `expense` WHERE `tour_package_id`='" . $bookingData['tour_package_id'] . "'");
            if ($expenseResultSet->num_rows > 0) {
                while ($expenseData = $expenseResultSet->fetch_assoc()) {
                    $groupedData[$yearMonth]['expense'] += $expenseData['other_expence'] + $expenseData['hotel_expence'];
                }
            }
        }

        // Prepare final output
        foreach ($groupedData as $yearMonth => $values) {
            $data['monthList'][] = $yearMonth;
            $data['incomeList'][] = $values['income'];
            $data['expenseList'][] = $values['expense'];
        }
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
} else {
    // Invalid HTTP method
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Invalid HTTP method. Use GET."]);
    exit;
}
?>