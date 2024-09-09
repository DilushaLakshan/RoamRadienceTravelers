<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    $uID = $_SESSION["user"]->id;

    if (isset($_POST["jsonText"])) {
        $jsonText = $_POST["jsonText"];
        $dataObject = json_decode($jsonText);

        $fName = $dataObject->fName;
        $lName = $dataObject->lName;
        $email = $dataObject->email;
        $password = $dataObject->password;
        $contact = $dataObject->contact;
        $hNo = $dataObject->homeNo;
        $street1 = $dataObject->street1;
        $street2 = $dataObject->street2;

        if (
            empty($fName) || empty($lName) || empty($email) ||
            empty($password) || empty($contact) || empty($hNo) || empty($street1) || empty($street2)
        ) {
            echo "Please fill the required areas...!";
        } else if (strlen($fName) > 20) {
            echo "First name should be less than 20 characters";
        } else if (strlen($lName) > 20) {
            echo "Last Name  should be less than 20 characters";
        } else if (strlen($email) > 45) {
            echo "Email should be less than 45 charcters";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Enter a valid email";
        } else if (strlen($password) != 8) {
            echo "Password must have 8 characters";
        } else if (strlen($contact) != 10) {
            echo "Contact number does not contain 10 numbers";
        } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $contact)) {
            echo "Enter a valid contact number";
        } else {
            // update the user
            Database::insertUpdateDelete("UPDATE `traveler` SET `first_name`='".$fName."', `last_name`='".$lName."', 
            `email`='".$email."', `password`='".$password."', `house_no`='".$hNo."', `street_1`='".$street1."', `street_2`='".$street2."', `contact`='".$contact."' WHERE `id`='".$uID."'");
            
            echo "Success";
        }
    }
}

?>
