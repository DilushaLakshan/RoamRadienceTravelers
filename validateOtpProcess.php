<?php
require 'connection.php';

if (!isset($_POST["otp"]) || !isset($_POST["email"])) {
    echo "Something went wrong";
} else if (empty($_POST["otp"])) {
    echo "Enter the OTP";
} else if (strlen($_POST["otp"]) != 6) {
    echo "Invalid OTP";
} else if (!is_numeric($_POST["otp"])) {
    echo "Invalid OTP";
} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email";
} else if (strlen($_POST["email"]) > 45) {
    echo "Email is too long";
} else {
    $email = $_POST["email"];
    $otp = $_POST["otp"];

    $userResultSet = Database::search("SELECT * FROM `traveler` WHERE `email`='" . $email . "' AND `otp`='" . $otp . "'");
    $userNumRows = $userResultSet->num_rows;

    if ($userNumRows == 1) {
        $userData = $userResultSet->fetch_assoc();

        $otpSendDateTimeObject = strtotime($userData['otp_send_date_time']);

        $date = new DateTime();
        $timeZone = new DateTimeZone('Asia/colombo');
        $date->setTimezone($timeZone);
        $currentDateTimeObject = strtotime($date->format('Y-m-d H:i:s'));

        $dateDifferenceInSeconds = abs($currentDateTimeObject - $otpSendDateTimeObject);

        // remove otp and otp send time
        Database::insertUpdateDelete("UPDATE `traveler` SET `otp`='', `otp_send_date_time`='2024-01-02 00:00:00' WHERE `id`='".$userData['id']."'");

        if($dateDifferenceInSeconds/60 > 15){
            echo "OTP has been expired";
        } else {
            echo "success";
        }
    } else {
        echo "Invalid OTP";
    }
}
?>