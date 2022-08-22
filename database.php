<?php



// starting session
 session_start();

 


// Messages
$_SESSION["message"] = "";
$_SESSION["msg_type"] = "";


// This is the database file
// Database variables
$db_host = "localhost";
$db_user = "enter user here";
$db_password = "enter password here";
$db_name = "mybugtracker";



// connecting
$conn = new mysqli($db_host,$db_user,$db_password,$db_name) or die(mysqli_error($conn));





?>

