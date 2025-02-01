<?php
require 'connection.php';

if (!isset($_POST["jsonText"])) {
    echo "<div class='col-12'><center><span><i>Something went wrong</i></span></center></div>";
    exit();
}

$jsonText = $_POST["jsonText"];
$dataObject = json_decode($jsonText);
$selectedCategoryList = $dataObject->selectedCategoryList;

if (empty($selectedCategoryList)) {
    echo "<div class='col-12'><center><span><i>Select a category to filter destinations</i></span></center></div>";
    exit();
}

$destinationIds = [];

// Fetch destination IDs based on selected categories
foreach ($selectedCategoryList as $categoryId) {
    $destinationIdResultSet = Database::search("SELECT `destination_id` FROM `destination_has_destination_category` WHERE `destination_category_id`='" . $categoryId . "'");
    while ($row = $destinationIdResultSet->fetch_assoc()) {
        if (!in_array($row['destination_id'], $destinationIds)) {
            $destinationIds[] = $row['destination_id'];
        }
    }
}

if (empty($destinationIds)) {
    echo "<div class='col-12'><center><span><i>No destinations found for the selected categories</i></span></center></div>";
    exit();
}

echo '<div class="col-12 p-2">';
echo '<div class="row">';

// Fetch and display destination details
foreach ($destinationIds as $destinationId) {
    $desResultSet = Database::search("SELECT * FROM `destination` WHERE `id`='" . $destinationId . "'");
    if ($desResultSet->num_rows == 1) {
        $desData = $desResultSet->fetch_assoc();

        echo '<div class="col-6 col-md-4 col-lg-4 mt-3">';
        echo '<div class="card destination-card">';

        // Fetch destination image
        $imageResultSet = Database::search("SELECT `src` FROM `destination_photo` WHERE `destination_id`='" . $destinationId . "' LIMIT 1");
        if ($imageResultSet->num_rows > 0) {
            $imageData = $imageResultSet->fetch_assoc();
            echo '<img src="resources/images/' . $imageData['src'] . '" class="card-img-top destination-card-img" alt="Destination">';
        } else {
            echo '<img src="resources/images/default-image.svg" class="card-img-top destination-card-img" alt="Default">';
        }

        echo '<div class="card-body">';
        echo '<center><h5 class="card-title">' . htmlspecialchars($desData['name']) . '</h5></center>';
        echo '<center><a href="destination-detail.php?desID=' . $destinationId . '" class="btn card-button">View details</a></center>';
        echo '</div>'; // Close card-body

        echo '</div>'; // Close card
        echo '</div>'; // Close col
    }
}
echo '</div>';
echo '</div>';
?>