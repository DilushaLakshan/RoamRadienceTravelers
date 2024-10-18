<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    $uID = $_SESSION["user"]->id;
    $comment = $_POST["comment"];
    $desID = $_POST["desID"];

    if (empty($comment)) {
        echo "Enter your comment here";
    } else if (strlen($comment) > 2000) {
        echo "Your comment is too long";
    } else {
        Database::insertUpdateDelete("INSERT INTO `destination_comment` (`description`, `destination_id`, `traveler_id`)
        VALUES ('" . $comment . "', '" . $desID . "', '" . $uID . "')");

        echo "success";
    }
} else{
    echo "Something went wrong";
}
?>
