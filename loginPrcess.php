<?php
session_start();
require 'connection.php';

$userName = $_POST["email"];
$password = $_POST["password"];


if (empty($userName) || empty($password)) {
    echo "Please fill the required areas...!";
} else {
    $loginResultSet1 = Database::search("SELECT * FROM `traveler` WHERE `email`='" . $userName . "' AND `password`='" . $password . "'");
    $loginNumRows1 = $loginResultSet1->num_rows;

    if ($loginNumRows1 == 1) {
        $loginData1 = $loginResultSet1->fetch_assoc();

        $user = new stdClass();
        $user->id = $loginData1["id"];
        $_SESSION["user"] = $user;

        echo "traveler";
    } else {
        $loginResultSet2 = Database::search("SELECT * FROM `staff_member_new` WHERE `email`='" . $userName . "' AND `password`='" . $password . "'");
        $loginNumRows2 = $loginResultSet2->num_rows;

        if ($loginNumRows2 == 1) {
            $loginData2 = $loginResultSet2->fetch_assoc();
            $role = $loginData2["role"];

            if ($role == "admin") {
                echo "admin";
            } else if ($role == "driver") {
                echo "driver";
            } else if ($role == "guide") {
                echo "guide";
            } else if ($role == "owner") {
                echo "owner";
            } else {
                echo "No role";
            }
        } else {
            echo "Invalid login";
        }
    }
}
