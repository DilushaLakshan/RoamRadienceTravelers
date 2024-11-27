<?php
session_start();
require 'connection.php';

if (isset($_POST["jsonText"]) && !empty($_POST["jsonText"])) {

    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);

    $desIDArray = $dataObject->desIDArray;
    $pIDList = [];
    $pItemNameList = [];
    
    for ($x = 0; $x < sizeof($desIDArray); $x++) {

        $pIdResultSet = Database::search("SELECT * FROM `packing_list_has_destination` WHERE `destination_id`='".$desIDArray[$x]."'");
        $pIdNumRows = $pIdResultSet->num_rows;

        if ($pIdNumRows > 0) {
            for ($y = 0; $y < $pIdNumRows; $y++) {
                $pIdData = $pIdResultSet->fetch_assoc();

                array_push($pIDList, $pIdData["packing_list_id"]);
            }
        }
    }

    for ($z = 0; $z < sizeof($pIDList); $z++) {
        $pItemResultSet = Database::search("SELECT * FROM `packing_list` WHERE `id`='".$pIDList[$z]."'");
        $pItemNumRows = $pItemResultSet->num_rows;

        if ($pItemNumRows == 1) {
            $pItemData = $pItemResultSet->fetch_assoc();

            array_push($pItemNameList, $pItemData["list_item"]);
        }
    }
    
    echo $pItemNameList;
} else {
    echo "No list available";
}
?>
