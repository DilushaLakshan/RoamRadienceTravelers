<?php
require 'connection.php';

if(isset($_POST['rating'])){
    $rating = $_POST['rating'];

    echo ($rating);
}
?>