<?php 


// This is the page for handling re-opened bugs


// Linking database
require_once("database.php");


// Adding Resolved bugs to reopen bugs table if reopen button is clicked
if(isset($_GET["reOpen"])){
    // Storing values passed through url
    $id = $_GET["reOpen"];
    $submitter = $_GET["reSub"];
    $title = $_GET["reTitle"];
    $severity = $_GET["reSeverity"];
    $description = $_GET["reDescription"];
    $dateSub = $_GET["dateSub"];

    // SQL Command
    $sqlInsert = "INSERT INTO reopenbugs (id,bug_submitter,bug_title,severity,bug_description,date_submitted)
    VALUES('$id','$submitter','$title','$severity','$description','$dateSub')";
    // Inserting bug values into re-openbugs table
    mysqli_query($conn, $sqlInsert);

    // Deleting bug values from resolvedbugs table
    $sqlDelete = "DELETE FROM resolvedbugs WHERE id=$id";
    mysqli_query($conn,$sqlDelete);
}

 header("Location: adminLogin.php");

?>