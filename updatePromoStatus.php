<?php
session_start();
require 'connection.php';

if(isset($_POST["jsonText"])){
    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);

    $proID = $dataObject->proID;
    $status = $dataObject->status;

    Database::insertUpdateDelete("UPDATE `promotion` SET `status`='".$status."' WHERE `id`='".$proID."'");

    echo "success";
} else{
    echo "Something went wrong";
}
?>