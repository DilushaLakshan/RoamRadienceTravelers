<?php
require 'connection.php';

if(isset($_GET["tID"]) && isset($_GET["statusID"]) && isset($_GET["bID"])){
    $travelerID = $_GET["tID"];
    $statusID = $_GET["statusID"];
    $bookingID = $_GET["bID"];

    Database::insertUpdateDelete("UPDATE `booking` SET `status_id`='".$statusID."' WHERE `traveler_id`='".$travelerID."' AND `id`='".$bookingID."'");
    echo "success";
}else{
    echo "Something went wrong";
}
?>