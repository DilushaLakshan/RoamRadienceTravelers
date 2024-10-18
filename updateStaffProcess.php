<?php
require 'connection.php';

if (isset($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];
    $object = json_decode($jsonText);

    $mID = $object->mID;
    $fName = $object->fName;
    $lName = $object->lName;
    $email = $object->email;
    $password = $object->password;
    $role = $object->role;
    $contact = $object->contact;


    if (
        empty($fName) || empty($lName) || empty($email) ||
        empty($password) || empty($contact)
    ) {
        echo "Please fill the required areas...!";
    } else if ($role == "not-selected") {
        echo "Select the role";
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

        //update the staff_member_new table
        Database::insertUpdateDelete("UPDATE `staff_member_new` SET 
        `first_name`='".$fName."', `last_name`='".$lName."', `email`='".$email."', 
        `password`='".$password."', `contact`='".$contact."', `role`='".$role."' WHERE `id`='".$mID."'");
        echo "success";
    }
} else {
    echo "Someting went wrong";
}
?>
