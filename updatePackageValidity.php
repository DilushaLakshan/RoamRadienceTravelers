<?php
require 'connection.php';

if(isset($_GET["pID"]) && isset($_GET["status"])){
    $pID = $_GET["pID"];
    $validity = $_GET["status"];

    Database::insertUpdateDelete("UPDATE `tour_package` SET `validity`='".$validity."' WHERE `id`='".$pID."'");
    echo "success";
}else{
    echo "Something went wrong";
}
?>