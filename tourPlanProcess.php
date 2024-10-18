<?php
session_start();
require 'connection.php';

if (isset($_POST["jsonText"])) {
    $uID = $_SESSION["user"]->id;

    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);
    $name = $dataObject->name;
    $tourDate = $dataObject->tourDate;
    $desIDList = explode(",", $dataObject->desIDList);

    if (empty($name)) {
        echo "Enter a name for your tour/ plan";
    } else if (strlen($name) > 45) {
        echo "Name is too long";
    } else if (empty($tourDate)) {
        echo "Enter the date of your tour";
    } else if (empty($desIDList)) {
        echo "Select destinations that you planning to visit";
    } else {
        // insert data to the self_tour_plan ralation
        Database::insertUpdateDelete("INSERT INTO `self_tour_plan` (`name`, `date`, `traveler_id`) 
        VALUES ('".$name."', '".$tourDate."', '".$uID."')");

        // get self_tour_plan id
        $planResultSet = Database::search("SELECT * FROM `self_tour_plan` WHERE `name`='".$name."' && `date`='".$tourDate."' && `traveler_id`='".$uID."'");
        $planNumRows = $planResultSet->num_rows;
        if($planNumRows == 1){
            $planData = $planResultSet->fetch_assoc();

            // insert data to self_tour_plan_has_destination relation
            for($x = 0; $x < sizeof($desIDList); $x++){
                Database::insertUpdateDelete("INSERT INTO `self_tour_plan_has_destination` (`self_tour_plan_id`, `destination_id`) VALUES ('".$planData['id']."', '".$desIDList[$x]."')");
            }

            // code need to insert data to self_tour_plan_has_packing_list relation
            
            echo "Success";
        }
    }
}

?>
