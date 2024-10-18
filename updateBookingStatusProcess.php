<?php
require 'connection.php';

if(isset($_GET["tID"]) && isset($_GET["statusID"])){
    $travelerID = $_GET["tID"];
    $statusID = $_GET["statusID"];

    Database::insertUpdateDelete("UPDATE `booking` SET `status_id`='".$statusID."' WHERE `traveler_id`='".$travelerID."'");
    echo "success";
}else{
    echo "Something went wrong";
}
?>