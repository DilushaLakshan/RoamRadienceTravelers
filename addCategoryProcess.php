<?php
require 'connection.php';

if (isset($_POST["categoryName"])) {
    if (!empty($_POST["categoryName"])) {
        if (strlen($_POST["categoryName"]) <= 45) {
            $categoryName = $_POST["categoryName"];

            // insert the data
            Database::insertUpdateDelete("INSERT INTO `destination_category` (`name`) VALUES ('" . $categoryName . "')");

            echo "success";
        } else {
            echo "Category name is too long";
        }
    } else {
        echo "Enter the category name";
    }
} else {
    echo "Invalid request";
}
?>