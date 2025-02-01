<?php
require 'connection.php';

$result = Database::search("SELECT COUNT(*) AS count FROM `inquiry` WHERE `status`='0'");
$row = $result->fetch_assoc();
$notifiCount = $row['count'];

echo $notifiCount;
?>