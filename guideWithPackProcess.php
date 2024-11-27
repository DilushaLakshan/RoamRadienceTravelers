<?php
require 'connection.php';

if (isset($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);

    $memberID = $dataObject->memberID;
    $packageID = $dataObject->packageID;

    if ($packageID == 0) {
        echo "Select a package";
    } else if ($packageID == -1) {
        echo "No packages available";
    } else {
        if (!empty($memberID) && !empty($packageID)) {
            // check the guide relation whether records are available for the particular user
            $guidePackResultSet = Database::search("SELECT * FROM `guide` WHERE `staff_member_new_id`='" . $memberID . "'");
            $guidePackNumRows = $guidePackResultSet->num_rows;
            if ($guidePackNumRows == 1) {
                // update the existing record
                Database::insertUpdateDelete("UPDATE `guide` SET `tour_package_id`='" . $packageID . "' WHERE `staff_member_new_id`='" . $memberID . "'");
                echo "success";
            } else {
                // insert a new record
                Database::insertUpdateDelete("INSERT INTO `guide` (`tour_package_id`, `staff_member_new_id`) VALUES ('" . $packageID . "', '" . $memberID . "')");
                echo "success";
            }
        } else {
            echo "Something went wrong";
        }
    }
} else {
    echo "Something went wrong";
}
?>
