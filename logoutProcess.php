<?php
session_start();

session_start(); // Start the session

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page or home page
header("Location: index.php");
exit();
?>