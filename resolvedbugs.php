<?php

 // This is the page for handling resolved bugs


 // linking database
 require_once("database.php");


// Adding Resolved bugs to database
if(isset($_GET["resolve"])){
    $id = $_GET["resolve"];
    $sub = $_GET["sub"];
    $bug_title = $_GET["title"];
    $bug_severity = $_GET["severity"];
    $bug_description = $_GET["description"];
    $resolvedBy = $_GET["resolvedBy"];
    $dateSub = $_GET["dateSub"];
    

   // SQL Command
   $sqlInsert = "INSERT INTO resolvedbugs (id,bug_submitter,bug_title,bug_severity,bug_description,date_submitted,Resolved_by)
   VALUES('$id','$sub','$bug_title','$bug_severity','$bug_description','$dateSub', '$resolvedBy')";
   // Inserting values into resolvedbugs table
   mysqli_query($conn,$sqlInsert);


   // Deleting from assigned bugs table
   $sqlDelete = "DELETE FROM assigned_bugs WHERE id='$id' ";
   mysqli_query($conn,$sqlDelete);


   header("Location: developerLogin.php");
}


?>