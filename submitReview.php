<?php
session_start();
require 'connection.php';

if ($_SESSION["user"]) {
    $uId = $_SESSION["user"]->id;

    if (isset($_POST["country"]) && isset($_POST["message"])) {
        if (empty($_POST["country"]) || empty($_POST["message"])) {
            echo "Fill the required areas";
        } else if (strlen($_POST["country"]) > 100) {
            echo "Country name is too long";
        } else if (strlen($_POST["message"]) > 1000) {
            echo "Message is too long";
        } else {
            $country = $_POST["country"];
            $message = $_POST["message"];

            // get the current date
            $date = new DateTime('now', new DateTimeZone('Asia/Colombo'));
            $currentDate = $date->format('Y-m-d');

            Database::insertUpdateDelete("INSERT INTO `review` 
            (`message`, `date`, `country`, `traveler_id`) 
            VALUES ('" . $message . "', '" . $currentDate . "', '" . $country . "', '" . $uId . "')");

            echo "success";
        }
    } else {
        echo "Invalid request";
    }
}
?>