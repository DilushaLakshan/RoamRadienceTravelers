<?php
require 'connection.php';

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
    // code needed to insert data to the self_tour_plan table and other relevant relations
}
?>
