<?php
require 'connection.php';

if(isset($_GET["mID"]) && isset($_GET["sID"])){
    $mID = $_GET["mID"];
    $accessStatus = $_GET["sID"];

    Database::insertUpdateDelete("UPDATE `staff_member_new` SET `access_status_id`='".$accessStatus."' WHERE `id`='".$mID."'");
    echo "success";
}else{
    echo "Something went wrong";
}
?>