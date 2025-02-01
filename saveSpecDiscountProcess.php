<?php
require 'connection.php';

if(isset($_POST["specDiscount"]) && isset($_POST["bookingId"])){
    if(!empty($_POST["specDiscount"]) || !empty($_POST["bookingId"])){
        $bookingId = $_POST["bookingId"];
        $specDiscount = $_POST["specDiscount"];

        // save the data to database
        Database::insertUpdateDelete("UPDATE `booking` SET `special_discount`='".$specDiscount."' WHERE `id`='".$bookingId."'");

        echo "success";
    } else{
        echo "Empty request";
    }
} else {
    echo "Invalid request";
}
?>