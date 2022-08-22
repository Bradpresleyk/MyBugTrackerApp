<?php 

// This page is to close reopen bugs by deleting them

// Linking Database
require_once("database.php");

// Closing Bugs for good by deleting
if(isset($_GET["close"])){
   // Adding to closed bugs to closed bugs table

   $id = $_GET["close"];
   $sub = $_GET["sub"];
   $title = $_GET["title"];
   $severity = $_GET["severity"];
   $description = $_GET["description"];

   $sqlInsert = "INSERT INTO closedbugs (id,bug_submitter,bug_title,severity,bug_description) 
   VALUES ('$id','$sub','$title','$severity','$description')";
   mysqli_query($conn, $sqlInsert);


   // Deleting Closed bugs
   $sqlDelete = "DELETE FROM reopenbugs WHERE id=$id";
   mysqli_query($conn, $sqlDelete);

   header("Location: adminLogin.php");
}


if(isset($_GET["close2"])){
   $id = $_GET["close2"];
   $sub = $_GET["sub"];
   $title = $_GET["title"];
   $severity = $_GET["severity"];
   $description = $_GET["description"];

   $sqlInsert = "INSERT INTO closedbugs (id,bug_submitter,bug_title,severity,bug_description) 
   VALUES ('$id','$sub','$title','$severity','$description')";
   mysqli_query($conn, $sqlInsert);


   // Deleting Closed bugs
   $sqlDelete = "DELETE FROM resolvedbugs WHERE id=$id";
   mysqli_query($conn, $sqlDelete);

   header("Location: adminLogin.php");

}


?>