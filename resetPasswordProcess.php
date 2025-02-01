<?php
require 'connection.php';

if (!isset($_POST["email"]) || !isset($_POST["newPassword"]) || !isset($_POST["confirmPassword"])) {
    echo "Something went wrong";
} else if (empty($_POST["newPassword"])) {
    echo "Enter your new password";
} else if (strlen($_POST["newPassword"]) != 8) {
    echo "Password must have 8 characters";
} else if (empty($_POST["confirmPassword"])) {
    echo "Confirm the password";
} else if (strlen($_POST["confirmPassword"]) != 8) {
    echo "Password must have 8 characters";
} else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "Enter a valid email";
} else if (strlen(($_POST["email"])) > 45) {
    echo "Email is too long";
} else if ($_POST["newPassword"] != $_POST["confirmPassword"]) {
    echo "Passwords are not matched";
} else {
    $password = $_POST["newPassword"];
    $email = $_POST["email"];

    $userResultSet = Database::search("SELECT * FROM `traveler` WHERE `email`='" . $email . "'");
    $userNumRows = $userResultSet->num_rows;

    if ($userNumRows == 1) {
        Database::insertUpdateDelete("UPDATE `traveler` SET `password`='" . $password . "' WHERE `email`='" . $email . "'");

        echo "success";
    } else {
        echo "Email not found";
    }
}
?>