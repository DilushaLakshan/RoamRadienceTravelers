<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    if (isset($_POST["jsonText"])) {
        $jsonText = $_POST["jsonText"];
        $dataObject = json_decode($jsonText);

        $promoId = $dataObject->promoID;
        $packageIdList = $dataObject->packageIds;

        if (!empty($promoId)) {
            if (is_array($packageIdList) && !empty($packageIdList)) {
                foreach ($packageIdList as $packageId) {
                    // Insert data into the table
                    Database::insertUpdateDelete("INSERT INTO `tour_package_has_promotion` (`tour_package_id`, `promotion_id`)
                    VALUES ('" . $packageId . "', '" . $promoId . "')");
                }
                echo "success";
            } else {
                echo "Select the tour packages";
            }
        } else {
            echo "Promotion ID is missing";
        }
    } else {
        echo "Something went wrong";
    }
}
?>