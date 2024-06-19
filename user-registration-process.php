<?php
require 'connection.php';

$fName = $_POST["firstName"];
$lName = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];
$contact = $_POST["contact"];
$houseNo = $_POST["houseNo"];
$street1 = $_POST["street1"];
$street2 = $_POST["street2"];

if (
    empty($fName) || empty($lName) || empty($email) ||
    empty($password) || empty($contact) || empty($houseNo) || empty($street1) || empty($street2)
) {
    echo "Please fill the required areas...!";
} else if (strlen($fName > 20)) {
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

    //insert data to the traveler relation
    Database::insertUpdateDelete("INSERT INTO `traveler` (`first_name`,`last_name`,`email`,`password`,`contact`,`house_no`,`street_1`,`street_2`) VALUES ('" . $fName . "','" . $lName . "','" . $email . "','" . $password . "','" . $contact . "','" . $houseNo . "','" . $street1 . "','" . $street2 . "')");
    echo "success";
}
