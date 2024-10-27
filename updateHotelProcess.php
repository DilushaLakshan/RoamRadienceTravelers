<?php
require 'connection.php';

if (isset($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];

    if (!empty($jsonText)) {
        $dataObject = json_decode($jsonText);

        $hID = $dataObject->hID;
        $name = $dataObject->name;
        $address = $dataObject->address;
        $email = $dataObject->email;
        $contact = $dataObject->contact;
        $noOfRooms = $dataObject->numberOfRooms;
        $roomPrice = $dataObject->pricePerRoom;

        if (empty($name)) {
            echo "Enter the name of the hotel";
        } else if (strlen($name) > 45) {
            echo "Hotel name is too long";
        } else if (empty($address)) {
            echo "Enter the hotel address";
        } else if (strlen($address) > 100) {
            echo "Hotel address is too long";
        } else if (empty($email)) {
            echo "Enter the email";
        } else if (strlen($email) > 45) {
            echo "Email is too long";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Enter a valid email";
        } else if (empty($contact)) {
            echo "Enter the contact number";
        } else if (strlen($contact) != 10) {
            echo "Contact number must have 10 characters";
        } else if (!preg_match("/^(07[0-8]|01[0-9]|03[0-9])[0-9]{7}$/", $contact)) {
            echo "Enter a valid contact number";
        } else if (empty($noOfRooms)) {
            echo "Enter the number of rooms";
        } else if ($noOfRooms < 1 || $noOfRooms > 30) {
            echo "Enter a valid number for number of rooms";
        } else if (empty($roomPrice)) {
            echo "Enter the price per room";
        } else {
            Database::insertUpdateDelete("UPDATE `hotel` SET `name`='" . $name . "', `address`='" . $address . "', 
            `email`='" . $email . "', `contact`='" . $contact . "', `no_of_room`='" . $noOfRooms . "', `price`='" . $roomPrice . "' WHERE `id`='" . $hID . "'");

            echo "success";
        }
    } else {
        echo "Someting went wrong";
    }
} else {
    echo "Something went wrong";
}
?>
