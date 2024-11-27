<?php
require 'connection.php';

if (isset($_POST["jsonText"])) {
    $jsonText = $_POST["jsonText"];
    $dataObject = json_decode($jsonText);
    $desID = $dataObject->desID;
    $name = $dataObject->name;
    $description = $dataObject->description;
    $imageFile = null;

    // Check if image is uploaded
    if (isset($_FILES["path"]) && $_FILES["path"]["error"] == 0) {
        $path = $_FILES["path"];
        $extension = $path["type"];
        $allowedImageExtensions = array("image/jpg", "image/png", "image/jpeg");

        // Validate image extension
        if (in_array($extension, $allowedImageExtensions)) {
            // Keep original extension
            $fileExtension = pathinfo($path["name"], PATHINFO_EXTENSION);
            $imageFile = $name . uniqid() . "." . $fileExtension;

            // Move file and check for success
            if (!move_uploaded_file($path["tmp_name"], "resources/images/" . $imageFile)) {
                echo "Failed to upload image.";
                exit();
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and JPEG are allowed.";
            exit();
        }
    } else {
        echo "Please select an image to upload.";
        exit();
    }

    // Validate form fields
    if (empty($name)) {
        echo "Enter the destination name";
    } else if (strlen($name) > 45) {
        echo "Destination name is too long";
    } else if (empty($description)) {
        echo "Complete the description";
    } else if (strlen($description) > 5000) {
        echo "Description is too long";
    } else {
        // update the destination table
        Database::insertUpdateDelete("UPDATE destination SET name='" . $name . "', description='" . $description . "' WHERE id='" . $desID . "'");

        // update the destination_photo table
        Database::insertUpdateDelete("UPDATE destination_photo SET src='" . $imageFile . "' WHERE destination_id='" . $desID . "'");

        echo "success";
    }
} else {
    echo "Something went wrong";
}
?>
