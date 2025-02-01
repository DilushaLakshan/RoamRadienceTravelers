<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    $uID = $_SESSION["user"]->id;

    if (isset($_POST["message"])) {
        if (empty($_POST["message"])) {
            echo "Enter the message";
        } else {
            $message = $_POST["message"];
            $status = 0;

            date_default_timezone_set("Asia/Colombo");
            $date = date("Y-m-d");

            Database::insertUpdateDelete("INSERT INTO `inquiry` (`traveler_id`,`message`,`date`, `status`) VALUES ('".$uID."', '".$message."', '".$date."', '".$status."')");

            echo "success";
        }
    }
} else {
    echo "Something went wrong";
}
?>