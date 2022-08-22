<?php

// This is the page for handling deletes

// Linking database
require_once("database.php");

// Handling deletes on resolved bugs tab
if(isset($_GET["delete"])){
    $id = $_GET["delete"];

   // Deleting from reolvedbugs table
    $sqlDelete = "DELETE FROM closedbugs WHERE id=$id";
    mysqli_query($conn, $sqlDelete);

   

    header("Location: UserDisplay.php");
}








?>