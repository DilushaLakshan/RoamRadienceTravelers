<?php
require 'connection.php';

if (isset($_POST["startDate"]) && isset($_POST["endDate"])) {
    if (!empty($_POST["startDate"]) && !empty($_POST["endDate"])) {
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];

        $allTourPackage = 0;
        $newCustomers = 0;
        $allCustomers = 0;
        $totalBooking = 0;
        $totalIncome = 0;
        $totalExpences = 0;
        $totalDiscount = 0;
        $netProfit = 0;
        $drivers = 0;
        $guides = 0;
        $vehicles = 0;
        $hotels = 0;
        $totalVehicleExpence = 0;
        $totalHotelExpence = 0;
        $mostDemandingPackage = "";
        $mostDemPackBookings = 0;
        $leastDemandingPackage = "";
        $leastDemPackBookings = 0;
        $packageList = [];
        $bookingCountList = [];
        $bookingIncomeList = [];
        $bookingExpenceList = [];
        $monthlyIncome = [];
        $monthlyExpenses = [];
        $bookingStatusId = 2;

        // Count the drivers
        $driverResult = Database::search("SELECT COUNT(*) AS total FROM `staff_member_new` WHERE `role`='driver'");
        if ($driverResult->num_rows == 1) {
            $driverData = $driverResult->fetch_assoc();
            $drivers = $driverData['total'];
        }

        // Count the guides
        $guideResult = Database::search("SELECT COUNT(*) AS total FROM `staff_member_new` WHERE `role`='guide'");
        if ($guideResult->num_rows == 1) {
            $guideData = $guideResult->fetch_assoc();
            $guides = $guideData['total'];
        }

        // Count the vehicles
        $vehicleResult = Database::search("SELECT COUNT(*) AS total FROM `vehicle`");
        if ($vehicleResult->num_rows == 1) {
            $vehicleData = $vehicleResult->fetch_assoc();
            $vehicles = $vehicleData['total'];
        }

        // Count the hotels
        $hotelResult = Database::search("SELECT COUNT(*) AS total FROM `hotel`");
        if ($hotelResult->num_rows == 1) {
            $hotelData = $hotelResult->fetch_assoc();
            $hotels = $hotelData['total'];
        }

        // Count the total bookings within the date range
        $bookingResult = Database::search("SELECT * FROM `booking` WHERE `date` BETWEEN '$startDate' AND '$endDate'");
        $totalBooking = $bookingResult->num_rows;

        if ($totalBooking > 0) {
            while ($bookingData = $bookingResult->fetch_assoc()) {
                // Calculate the total income and discount
                $paymentResult = Database::search("SELECT * FROM `payment` WHERE `booking_id`='" . $bookingData['id'] . "'");
                if ($paymentResult->num_rows == 1) {
                    $paymentData = $paymentResult->fetch_assoc();
                    $totalIncome += $paymentData["amount"];
                    $totalDiscount += $paymentData["discount"];
                }

                // Calculate total expenses excluding vehicle expenses
                $expenseResult = Database::search("SELECT * FROM `expense` WHERE `tour_package_id`='" . $bookingData['tour_package_id'] . "'");
                while ($expenseData = $expenseResult->fetch_assoc()) {
                    $totalExpences += $expenseData["other_expence"] + $expenseData["hotel_expence"];
                }
            }
        }

        // Find the most demanding tour package
        $mostDemandingResult = Database::search("SELECT `tour_package_id`, COUNT(*) AS frequency FROM `booking` 
            WHERE `date` BETWEEN '$startDate' AND '$endDate' 
            GROUP BY `tour_package_id` ORDER BY frequency DESC LIMIT 1");
        if ($mostDemandingResult->num_rows == 1) {
            $mostDemandingData = $mostDemandingResult->fetch_assoc();
            $mostDemPackBookings = $mostDemandingData['frequency'];

            // Get the name of the most demanding package
            $packageResult = Database::search("SELECT `name` FROM `tour_package` WHERE `id`='" . $mostDemandingData['tour_package_id'] . "'");
            if ($packageResult->num_rows == 1) {
                $packageData = $packageResult->fetch_assoc();
                $mostDemandingPackage = $packageData['name'];
            }
        }

        // Find the least demanding tour package
        $leastDemandingResult = Database::search("SELECT `tour_package_id`, COUNT(*) AS frequency FROM `booking` 
            WHERE `date` BETWEEN '$startDate' AND '$endDate' 
            GROUP BY `tour_package_id` ORDER BY frequency ASC LIMIT 1");
        if ($leastDemandingResult->num_rows == 1) {
            $leastDemandingData = $leastDemandingResult->fetch_assoc();
            $leastDemPackBookings = $leastDemandingData['frequency'];

            // Get the name of the least demanding package
            $packageResult = Database::search("SELECT `name` FROM `tour_package` WHERE `id`='" . $leastDemandingData['tour_package_id'] . "'");
            if ($packageResult->num_rows == 1) {
                $packageData = $packageResult->fetch_assoc();
                $leastDemandingPackage = $packageData['name'];
            }
        }

        // Calculate the net profit
        $netProfit = $totalIncome - $totalDiscount - $totalExpences;

        // Count all valid tour packages
        $tourPackageResult = Database::search("SELECT COUNT(*) AS total FROM `tour_package` WHERE `validity`='true'");
        if ($tourPackageResult->num_rows == 1) {
            $tourPackageData = $tourPackageResult->fetch_assoc();
            $allTourPackage = $tourPackageData['total'];
        }

        // get the bookings count for each tour package between two dates
        $bookingRS2 = Database::search("
        SELECT `tour_package_id`, COUNT(*) AS `booking_count` 
        FROM `booking` 
        WHERE `date` BETWEEN '" . $startDate . "' AND '" . $endDate . "' 
        GROUP BY `tour_package_id`
        ");

        while ($bookingData2 = $bookingRS2->fetch_assoc()) {
            $tourPackageId = $bookingData2['tour_package_id'];
            $bookingCount = $bookingData2['booking_count'];

            // fetch the package data according to id
            $packageRS2 = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $tourPackageId . "'");
            $packageNumRows2 = $packageRS2->num_rows;

            if ($packageNumRows2 == 1) {
                $packageData2 = $packageRS2->fetch_assoc();

                array_push($packageList, $packageData2["name"]);
                array_push($bookingCountList, $bookingCount);
            }
        }

        // Prepare data for JavaScript
        $chartData  = [
            "packageNameList" => $packageList,
            "packageBookingCountList" => $bookingCountList,
        ];

        // Fetch the data for calculating income and expenses
        $bookingRS3 = Database::search("SELECT * FROM `booking` WHERE `status_id`='" . $bookingStatusId . "' AND `date` BETWEEN '" . $startDate . "' AND '" . $endDate . "'");
        $bookingNumRows3 = $bookingRS3->num_rows;

        if ($bookingNumRows3 > 0) {
            for ($x = 0; $x < $bookingNumRows3; $x++) {
                $bookingData3 = $bookingRS3->fetch_assoc();

                // Extract the month and year from the booking date
                $bookingMonth = date("Y-m", strtotime($bookingData3['date']));

                // Fetch the relevant package's expenses
                $expenceRS3 = Database::search("SELECT * FROM `expense` WHERE `tour_package_id`='" . $bookingData3['tour_package_id'] . "'");
                if ($expenceRS3->num_rows > 0) {
                    for ($p = 0; $p < $expenceRS3->num_rows; $p++) {
                        $expenceData3 = $expenceRS3->fetch_assoc();
                        $totalExpense = $expenceData3["other_expence"] + $expenceData3["hotel_expence"];

                        // Fetch the relevant payment record - income
                        $paymentRS3 = Database::search("SELECT * FROM `payment` WHERE `booking_id`='" . $bookingData3['id'] . "'");
                        $income = 0;
                        if ($paymentRS3->num_rows == 1) {
                            $paymentData3 = $paymentRS3->fetch_assoc();
                            $income = $paymentData3["amount"];
                        }

                        // Aggregate income and expenses by month
                        if (!isset($monthlyIncome[$bookingMonth])) {
                            $monthlyIncome[$bookingMonth] = 0;
                        }
                        if (!isset($monthlyExpenses[$bookingMonth])) {
                            $monthlyExpenses[$bookingMonth] = 0;
                        }

                        $monthlyIncome[$bookingMonth] += $income;
                        $monthlyExpenses[$bookingMonth] += $totalExpense;
                    }
                }
            }
        }

        // Prepare data for the chart
        $months = array_keys($monthlyIncome); // Get months for labels
        $incomeData = array_values($monthlyIncome);
        $expenseData = array_values($monthlyExpenses);

        $groupedChartData = [
            "months" => $months,
            "incomeData" => $incomeData,
            "expenseData" => $expenseData
        ];

        // // fetch the data for calculating income and expences
        // $bookingRS3 = Database::search("SELECT * FROM `booking` WHERE `status_id`='" . $bookingStatusId . "' AND `date` BETWEEN '" . $startDate . "' AND '" . $endDate . "'");
        // $bookingNumRows3 = $bookingRS3->num_rows;

        // if ($bookingNumRows3 > 0) {
        //     for ($x = 0; $x < $bookingNumRows3; $x++) {
        //         $bookingData3 = $bookingRS3->fetch_assoc();

        //         // fetch the relevant package's expences
        //         $expenceRS3 = Database::search("SELECT * FROM `expense` WHERE `tour_package_id`='" . $bookingData3['tour_package_id'] . "'");
        //         if ($expenceRS3->num_rows > 0) {
        //             for ($p = 0; $p < $expenceRS3->num_rows; $p++) {
        //                 $expenceData3 = $expenceRS3->fetch_assoc();
        //                 $totalExpenceChartData = $expenceData3["other_expence"] + $expenceData3["hotel_expence"];

        //                 // fetch the relevant payment record - income
        //                 $paymentRS3 = Database::search("SELECT * FROM `payment` WHERE `booking_id`='" . $bookingData3['id'] . "'");
        //                 if ($paymentRS3->num_rows == 1) {
        //                     $paymentData3 = $paymentRS3->fetch_assoc();

        //                     array_push($bookingIncomeList, $paymentData3["amount"]);
        //                     array_push($bookingExpenceList, $totalExpenceChartData);
        //                 } else {
        //                     array_push($bookingIncomeList, 0);
        //                     array_push($bookingExpenceList, $totalExpenceChartData);
        //                 }
        //             }
        //         }
        //     }
        // }

        $htmlContent = '
        <div class="row">
        <div class="col-6"><span>Number of Tour Packages: </span><p>' . $allTourPackage . '</p></div>
        <div class="col-6"><span>Total Cusomers: </span><p>' . $allCustomers . '</p></div>
        <div class="col-6"><span>Total Bookings: </span><p>' . $totalBooking . '</p></div>
        <div class="col-6"><span>Total Income: </span><p>' . $totalIncome . '</p></div>
        <div class="col-6"><span>Total Expences: </span><p>' . $totalExpences . '</p></div>
        <div class="col-6"><span>Total Discount: </span><p>' . $totalDiscount . '</p></div>
        <div class="col-6"><span>Net Profit: </span><p>' . $netProfit . '</p></div>
        <div class="col-6"><span>Drivers: </span><p>' . $drivers . '</p></div>
        <div class="col-6"><span>Guides: </span><p>' . $guides . '</p></div>
        <div class="col-6"><span>Vehicles: </span><p>' . $vehicles . '</p></div>
        <div class="col-6"><span>Hotels: </span><p>' . $hotels . '</p></div>
        <div class="col-6"><span>Total Hotel Expences: </span><p>' . $totalHotelExpence . '</p></div>
        <div class="col-6"><span>Most Demanding Package: </span><p>' . $mostDemandingPackage . ' (' . $mostDemPackBookings . ' bookings)</p></div>
        <div class="col-6"><span>Least Demanding Package: </span><p>' . $leastDemandingPackage . ' (' . $leastDemPackBookings . ' bookings)</p></div>
        <hr>';


        // Add content dynamically from the loop
        for ($x = 0; $x < sizeof($packageList); $x++) {
            $htmlContent .= '<div class="col-12"><span>' . $packageList[$x] . ' - </span><p>' . $bookingCountList[$x] . ' (booking count)</p></div>';
        }

        // Add remaining HTML content
        $htmlContent .= '
        <div class="col-12 mt-4"><div><canvas id="full-report-myChart"></canvas></div></div>
        <div class="col-12 mt-4"><div><canvas id="full-report-groupChart"></canvas></div></div>
        <div class="col-12 col-md-3 col-lg-3 offset-md-9 offset-lg-9 mt-4">
            <button class="btn btn-outline-danger" onclick="exportToPdf();">Download PDF</button>
        </div>
        </div>';

        echo json_encode([
            "html" => $htmlContent,
            "chartData" => $chartData,
            "groupedChartData" => $groupedChartData
        ]);
    }
}
