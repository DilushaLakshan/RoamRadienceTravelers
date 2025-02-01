<?php
session_start();
require 'connection.php';

if(isset($_POST["replyMessage"]) && isset($_POST["inqId"])){
    if(!empty($_POST["replyMessage"])){
        $inqId = $_POST["inqId"];
        $reply = $_POST["replyMessage"];

        if(strlen($reply) > 5000){
            echo "Message is too long";
        } else {
            // insert the reply and send email for question
            Database::insertUpdateDelete("INSERT INTO `inquiry_reply` (`response_message`, `inquiry_id`) VALUES ('".$reply."', '".$inqId."')");

            // update the status of inquiry
            Database::insertUpdateDelete("UPDATE `inquiry` SET `status`='1' WHERE `id`='".$inqId."'");
            
            // send the email sending functionality
            
            echo "success";
        }
    } else {
        echo "Enter the reply message...";
    }
} else {
    echo "Invalid Request";
}
?>