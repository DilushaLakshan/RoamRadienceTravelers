<?php
require 'connection.php';

// validate the data
if(!isset($_POST["hotelData"]) || empty($_POST["hotelData"])){
    echo "Hotel data is missing";
    exit;
}

$jsonText = $_POST["hotelData"];
$dataObject = json_decode($jsonText);

$name = $dataObject->hotelName;
$address = $dataObject->hotelAddress;
$email = $dataObject->email;
$contact = $dataObject->contact;
$numOfRooms = $dataObject->numberOfRooms;
$roomNumbers = explode(",", $dataObject->roomNumbers);
$roomType = $dataObject->roomType;
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
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $contact)) {
    echo "Enter a valid contact number";
} else if (empty($numOfRooms)) {
    echo "Enter the number of rooms";
} else if ($numOfRooms < 1 || $numOfRooms > 10) {
    echo "Enter a valid number for number of rooms";
} else if (empty($roomNumbers)) {
    echo "Enter the numbers of rooms";
} else if (sizeof($roomNumbers) != $numOfRooms) {
    echo "Check the number of rooms and room numbers";
} else if (empty($roomType)) {
    echo "Select the room type";
} else if(empty($roomPrice)){
    echo "Enter the price per room";
}else {
    // insert data to the hotel table
    Database::insertUpdateDelete("INSERT INTO `hotel` (`name`, `address`, `email`, `contact`, `no_of_room`, `price`) 
    VALUES ('" . $name . "', '" . $address . "', '" . $email . "', '" . $contact . "', '" . $numOfRooms . "', '".$roomPrice."')");

    // get the hotel id from the hotel table based on the email
    $hotelResultSet = Database::search("SELECT * FROM `hotel` WHERE `email`='" . $email . "' LIMIT 1");
    $hotelNumRows = $hotelResultSet->num_rows;
    if ($hotelNumRows > 0) {
        $hotelData = $hotelResultSet->fetch_assoc();

        for ($x = 0; $x < sizeof($roomNumbers); $x++) {
            Database::insertUpdateDelete("INSERT INTO `hotel_room` (`number`, `type`, `hotel_id`) 
            VALUES ('" . $roomNumbers[$x] . "', '" . $roomType . "', '" . $hotelData['id'] . "')");
        }
        echo "Success";
    }
}

?>
