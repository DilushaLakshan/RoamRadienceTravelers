<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    if (empty($_POST["rate"])) {
        echo "Set the rate";
    } else if (empty($_POST["description"])) {
        echo "Enter the commment";
    } else {
        $uID = $_SESSION["user"]->id;
        $description = $_POST["description"];
        $packageID = $_POST["packageID"];
        $rate = $_POST["rate"];

        Database::insertUpdateDelete("INSERT INTO `package_comment` (`description`, `tour_package_id`, `traveler_id`, `rate_status`)
        VALUES ('" . $description . "', '" . $packageID . "', '" . $uID . "', '".$rate."')");

        echo "success";
    }
} else {
    echo "login";
}
?>