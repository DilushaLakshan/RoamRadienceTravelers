<?php
session_start();
require 'connection.php';

if (!isset($_SESSION["user"]) || !isset($_POST["jsonText"])) {
    echo "Something went wrong";
} else {
    $uId = $_SESSION["user"]->id;
    $jsonText = $_POST["jsonText"];

    $dataObject = json_decode($jsonText);

    $packageId = $dataObject->packageId;
    $bookingId = $dataObject->bookingId;

    $packageResultSet = Database::search("SELECT * FROM `tour_package` WHERE `id`='" . $packageId . "'");
    $packageNumRows = $packageResultSet->num_rows;

    if ($packageNumRows == 1) {
        $packageData = $packageResultSet->fetch_assoc();


        $bookingResultSet = Database::search("SELECT * FROM `booking` WHERE `id`='" . $bookingId . "'");
        $bookingNumRows = $bookingResultSet->num_rows;
        if ($bookingNumRows == 1) {
            $bookingData = $bookingResultSet->fetch_assoc();

            $specDiscount = 0;
            $amount = $packageData["price"] * $bookingData["no_of_members"];
            $promotionDiscountList = [];

            if (!empty($bookingData["special_discount"])) {
                $specDiscount = $bookingData["special_discount"];

                // substract the special discount from amount
                $amount = $amount - $specDiscount;
            }

            // seach discounts for promotions
            $promoPackageResultSet = Database::search("SELECT * FROM `tour_package_has_promotion`  WHERE `tour_package_id`='" . $packageData['id'] . "'");
            $promoPackageNumRows = $promoPackageResultSet->num_rows;
            if ($promoPackageNumRows > 0) {
                for ($x = 0; $x < $promoPackageNumRows; $x++) {
                    $promoPackageData = $promoPackageResultSet->fetch_assoc();

                    // fetch the particular promotion data
                    $promotionResultSet = Database::search("SELECT * FROM `promotion` WHERE `id`='" . $promoPackageData['promotion_id'] . "'");
                    $promotionNumRows = $promotionResultSet->num_rows;
                    if ($promotionNumRows == 1) {
                        $promotionData = $promotionResultSet->fetch_assoc();

                        array_push($promotionDiscountList, $promotionData["discount"]);
                    }
                }
            }

            $grandTotal = $amount;
            $totalDiscount = $specDiscount;
            $status = "yes";

            // substract the promotion discounts if available
            if (sizeof($promotionDiscountList) > 0) {
                for ($y = 0; $y < sizeof($promotionDiscountList); $y++) {
                    $grandTotal = $grandTotal - $promotionDiscountList[$y];

                    $totalDiscount = $totalDiscount + $promotionDiscountList[$y];
                }
            }

            // save the payment data in the database
            Database::insertUpdateDelete("INSERT INTO `payment` (`status`, `amount`, `booking_id`, `discount`, `traveler_id`)
            VALUES ('" . $status . "', '" . $grandTotal . "', '" . $bookingId . "', '" . $totalDiscount . "', '" . $uId . "')");

            $amount = $grandTotal;
            $merchant_id = "1228987";
            $order_id = $bookingId;
            $merchant_secret = "MjYxMjc3MzU1MDI0NDQ0OTk2MjEzMzYzOTExNDUwMjc5MDQ0MTY4Nw==";
            $currency = "LKR";

            $hash = strtoupper(
                md5(
                    $merchant_id .
                        $order_id .
                        number_format($amount, 2, '.', '') .
                        $currency .
                        strtoupper(md5($merchant_secret))
                )
            );

            // fetch the real data from the database and replace the hardcoded
            $response = [
                "sandbox" => true,
                "merchant_id" => $merchant_id,
                "return_url" => "http://localhost/roamradiencetravelers/index.php",
                "cancel_url" => "http://localhost/roamradiencetravelers/index.php",
                "notify_url" => "http://localhost/roamradiencetravelers/notify",
                "order_id" => $bookingData["id"],
                "items" => $packageData["name"],
                "amount" => $amount,
                "currency" => $currency,
                "hash" => $hash,
                "first_name" => "Dilusha",
                "last_name" => "Lakshan",
                "email" => "chamindasanath99@gmail.com",
                "phone" => "0705195761",
                "address" => "Welikadamulla",
                "city" => "Attanagalla",
                "country" => "Sri Lanka",
                "delivery_address" => "151/C, Welikadamulla, Attanagalla",
                "delivery_city" => "Attanagalla",
                "delivery_country" => "Sri Lanka"
            ];

            echo json_encode($response);
        }
    }
}
?>