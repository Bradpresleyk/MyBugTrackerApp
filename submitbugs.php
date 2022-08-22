<?php

// This is page for submitting bugs
   
// linking to database
require_once("database.php");


$bug_submitter = $_SESSION["loggedInUser"];

$bug_severity = "";

if(isset($_POST["submit"])){
  // Sanitizing inputs
   $bug_title = filter_input(INPUT_POST, "bug_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   // checking bug severity
   if($_POST["select_dropdown"] == "low"){
      $bug_severity = "low";
   } else if($_POST["select_dropdown"] == "moderate"){
      $bug_severity = "moderate";
   } else if($_POST["select_dropdown"] == "major"){
      $bug_severity = "major";
   } else if($_POST["select_dropdown"] == "critical"){
      $bug_severity = "critical";
   }
   // Sanitizing bug description
   $bug_description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      
   
       $_SESSION["message"] = "Bug Submitted";
       $_SESSION["msg_type"] = "success";

       // Storing bugs in database
       $sqlInsert = "INSERT INTO bugs (bug_submitter, bug_title, severity, bug_description) VALUES('$bug_submitter','$bug_title','$bug_severity','$bug_description') ";
       mysqli_query($conn, $sqlInsert);
    

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Submit Bug</title>
</head>
<body>
<!-- NavBar -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
       <h5>Bug Tracker</h5>
      </nav>
      <!-- Displaying Messages -->
      <div class="mb-2 text-center alert alert-<?php echo $_SESSION["msg_type"] ?>">
        <?php echo $_SESSION["message"]; ?>
    </div>
     <!-- Form Container -->
    <div class="container">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="ml-5 w-75">
     <h1 class="text-center mb-4">Submit bugs or issues</h1>
    
     <!-- Bug title -->
     <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Bug Title</label>
    <input type="text" name="bug_title" class="form-control" id="exampleFormControlInput1" placeholder="Enter issue" required>
    </div>
     <!-- Severity -->
     <div class="mb-3">
      <label for="select">Severity</label>
     <select id="select" name="select_dropdown" class="form-select form-control" aria-label="Default select example">
     <option value="low">Low</option>
     <option value="moderate">Moderate</option>
     <option value="major">Major</option>
     <option value="critical">Critical</option>
     </select>
     </div>
    <!-- Description -->
    <div class="mb-4">
  <label for="exampleFormControlTextarea1" class="form-label">Bug Description</label>
  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Optional Bug Description"></textarea>
</div>
     <!-- Buttons -->
        <div class="mb-3">
        <input name="submit" type="submit" value="Submit" class="btn btn-primary">
        <a href="logout.php" class="btn btn-warning">Logout</a>
        <a href="UserDisplay.php" class="btn btn-info">View Submitted Bugs</a>
        </div>
        </div>
    </form>
    
</div>
</body>
</html>