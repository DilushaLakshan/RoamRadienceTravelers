<?php
session_start();
require 'connection.php';

if (isset($_SESSION["user"])) {
    if (isset($_POST["jsonText"])) {
        $uID = $_SESSION["user"]->id;
        $jsonText = $_POST["jsonText"];
        $dataObject = json_decode($jsonText);

        $pID = $dataObject->pID;
        $noOfMembers = $dataObject->noOfMembers;
        $date = $dataObject->date;
        $description = $dataObject->description;
        $statusID = 1;

        if (empty($noOfMembers)) {
            echo "Enter the number of members for joining the tour";
        } else if (empty($description)) {
            echo "Enter the other details you want to inform the agency";
        } else if (strlen($description) > 1000) {
            echo "Description is too long";
        } else {
            Database::insertUpdateDelete("INSERT INTO `booking` (`date`, `no_of_members`, `description`, `tour_package_id`, `traveler_id`, `status_id`)
            VALUES ('" . $date . "', '" . $noOfMembers . "', '" . $description . "', '" . $pID . "', '" . $uID . "', '" . $statusID . "')");

            echo "success";
        }
    }
} else {
    echo "Something went wrong";
}
?>
