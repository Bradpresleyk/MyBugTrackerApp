<?php 

// This is the admin page



// Linking database
require_once("database.php");


$_SESSION["message"] = "Testing";
$_SESSION["msg_type"] = "";


// Selecting bugs from database
$sqlSelect = "SELECT * FROM bugs";
$results = mysqli_query($conn, $sqlSelect);



// Selecting resolved bugs from database
$sql = "SELECT * FROM resolvedbugs";
$resolved_bugs = mysqli_query($conn, $sql);

// Selecting Re-Opened bugs from database
$sqlCommand = "SELECT * FROM reopenbugs";
$reOpenBugs = mysqli_query($conn,$sqlCommand);


// Fetching developer list to choose from in select dropdown
$sqlSelect = "SELECT * FROM users WHERE user_type = 'developer' ";
$devList = mysqli_query($conn,$sqlSelect);

// Selecting Assigned bugs from database
$sqlAssignedBugs = "SELECT * FROM assigned_bugs";
$sqlResults = mysqli_query($conn,$sqlAssignedBugs);


$choice = "";



// Getting developer name
if(isset($_POST["assign"])){
    // Storing Select Choice value in variable
   $devAssigned = $_POST["selected"];
   // Storing bug values in Variables
   $id = filter_input(INPUT_POST,"id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $sub = filter_input(INPUT_POST,"sub", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $title = filter_input(INPUT_POST,"title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $severity = filter_input(INPUT_POST,"severity", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $description = filter_input(INPUT_POST,"description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $dateSub = filter_input(INPUT_POST,"dateSub", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  

   // adding bugs to assigned table with name of developer assigned to when clicked assign
   $sqlInsert = "INSERT INTO assigned_bugs (id,submitter,title,severity,description,date_submitted,developer_assigned) 
   VALUES ('$id','$sub','$title','$severity','$description','$dateSub','$devAssigned')";
   mysqli_query($conn,$sqlInsert);

   // Deleting assigned bugs from open bugs table
   $sqlDelete = "DELETE FROM bugs WHERE id='$id' ";
   mysqli_query($conn,$sqlDelete);
   
   header("Location: adminLogin.php");

}


// Adding Bug Re-Assign functionality
if(isset($_POST["re-assign"])){
   // Storing value of Dev Re-assigned the bug
   $chosenDev = filter_input(INPUT_POST,"selectDev", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $re_id = filter_input(INPUT_POST,"re-id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $re_sub = filter_input(INPUT_POST,"re-sub", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $re_title = filter_input(INPUT_POST,"re-title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $re_severity = filter_input(INPUT_POST,"re-severity", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $re_description = filter_input(INPUT_POST,"re-description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $re_dateSub = $_POST["re-dateSub"];

   // Adding re-assigned bugs to assigned table when re-Assigned
   $sqlRe = "INSERT INTO assigned_bugs (id,submitter,title,severity,description,date_submitted,developer_assigned) 
   VALUES ('$re_id','$re_sub','$re_title','$re_severity','$re_description','$re_dateSub','$chosenDev')";
   mysqli_query($conn,$sqlRe);

   // Deleting re-assigned bugs from re-opened bugs table
   $sqlDelete = "DELETE FROM reopenbugs WHERE id='$re_id' ";
   mysqli_query($conn,$sqlDelete);

   header("Location: adminLogin.php");

    
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
    <title>Bug Tracker</title>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
       <h5>Bug Tracker</h5>
      </nav>
    <!-- Navbar Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <!-- Open Bugs Tab -->
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Open Bugs</button>
  </li>
  <!-- Assigned Bugs -->
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="assign-tab" data-bs-toggle="tab" data-bs-target="#assign-tab-pane" type="button" role="tab" aria-controls="assign-tab-pane" aria-selected="false">Assigned Bugs</button>
  </li>
  <!-- Resolved Bugs -->
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Resolved Bugs</button>
  </li>
  <!-- Re-opened Bugs -->
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Re-Opened Bugs</button>
  </li>
  
  
  
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
<!-- Table Displaying bugs -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Bug Submitter</th>
      <th scope="col">Bug Title</th>
      <th scope="col">Severity</th>
      <th scope="col">Bug Description</th>
      <th scope="col">Date Submitted</th>
      <th scope="col">Assign to</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <!-- Open Bugs -->
      <?php while($row = mysqli_fetch_assoc($results)):?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    
      <?php if($row["severity"] == "low") {
             $_SESSION["msg_type"] = "success";
} else if($row["severity"] == "moderate"){
             $_SESSION["msg_type"] = "primary";
} else if($row["severity"] == "major"){
             $_SESSION["msg_type"] = "warning";
} else if($row["severity"] == "critical"){
             $_SESSION["msg_type"] = "danger";
}


?>
 <input type="hidden"  name="id" value="<?php echo $row["id"]; ?>">
 <input type="hidden"  name="sub" value="<?php echo $row["bug_submitter"]; ?>">
 <input type="hidden"  name="title" value="<?php echo $row["bug_title"]; ?>">
 <input type="hidden"  name="severity" value="<?php echo $row["severity"]; ?>">
 <input type="hidden"  name="description" value="<?php echo $row["bug_description"]; ?>">
 <input type="hidden"  name="dateSub" value="<?php echo $row["date"]; ?>">
      <tr class="table-<?php echo $_SESSION["msg_type"]; ?>">
      <td><?php echo $row["bug_submitter"]; ?></td>
      <td><?php echo $row["bug_title"]; ?></td>
      <td><?php echo $row["severity"]; ?></td>
      <td><?php echo $row["bug_description"]; ?></td>
      <td><?php echo $row["date"]; ?></td>
      <td>  

        <select name="selected">
            <?php foreach($devList as $dev): ?>
            <option value="<?php echo $dev["username"] ?>"><?php echo $dev["username"] ?></option>
            <?php endforeach; ?>
       </select>

    </td>
      <td>
           <input type="submit" name="assign" value="Assign" class="btn btn-<?php echo $_SESSION["msg_type"] ?>">
      </td>
    </tr>
    
    </form>
    <?php endwhile; ?>
  </tbody>
</table>
  </div>
    <!-- Table Displaying Assigned Bugs -->
  <div class="tab-pane fade" id="assign-tab-pane" role="tabpanel" aria-labelledby="assign-tab" tabindex="0">

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Bug Submitter</th>
      <th scope="col">Bug Title</th>
      <th scope="col">Severity</th>
      <th scope="col">Bug Description</th>
      <th scope="col">Date Submitted</th>
      <th scope="col">Date Assigned</th>
      <th scope="col">Assigned to</th>
    </tr>
  </thead>
  <tbody>
      <!-- Assigned Bugs -->
      <?php while($rows = mysqli_fetch_assoc($sqlResults)):?>
    
      <?php if($rows["severity"] == "low") {
             $_SESSION["msg_type"] = "success";
} else if($rows["severity"] == "moderate"){
             $_SESSION["msg_type"] = "primary";
} else if($rows["severity"] == "major"){
             $_SESSION["msg_type"] = "warning";
} else if($rows["severity"] == "critical"){
             $_SESSION["msg_type"] = "danger";
}


?>
 
      <tr class="table-<?php echo $_SESSION["msg_type"]; ?>">
      <td><?php echo $rows["submitter"]; ?></td>
      <td><?php echo $rows["title"]; ?></td>
      <td><?php echo $rows["severity"]; ?></td>
      <td><?php echo $rows["description"]; ?></td>
      <td><?php echo $rows["date_submitted"]; ?></td>
      <td><?php echo $rows["date_assigned"]; ?></td>
      <td><?php echo $rows["developer_assigned"]; ?></td>
  
    <?php endwhile; ?>
  </tbody>
</table>
  </div>
    <!-- Table Displaying Resolved bugs -->
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Bug Submitter</th>
      <th scope="col">Bug Title</th>
      <th scope="col">Severity</th>
      <th scope="col">Bug Description</th>
      <th scope="col">Date Submitted</th>
      <th scope="col">Date Resolved</th>
      <th scope="col">Resolved By</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody> 
    <!-- fetching resolved bugs and adding them to reopened table if clicked reopen -->
     <?php while($row_value = mysqli_fetch_assoc($resolved_bugs)): ?>
      <!-- Checking Severity -->
      <?php if($row_value["bug_severity"] == "low") {
             $_SESSION["msg_type"] = "success";
} else if($row_value["bug_severity"] == "moderate"){
             $_SESSION["msg_type"] = "primary";
} else if($row_value["bug_severity"] == "major"){
             $_SESSION["msg_type"] = "warning";
} else if($row_value["bug_severity"] == "critical"){
             $_SESSION["msg_type"] = "danger";
}

?>

      <tr class="table-<?php echo $_SESSION["msg_type"]; ?>">
      <td><?php echo $row_value["bug_submitter"]; ?></td>
      <td><?php echo $row_value["bug_title"]; ?></td>
      <td><?php echo $row_value["bug_severity"]; ?></td>
      <td><?php echo $row_value["bug_description"]; ?></td>
      <td><?php echo $row_value["date_submitted"]; ?></td>
      <td><?php echo $row_value["date_resolved"]; ?></td>
      <td><?php echo $row_value["Resolved_by"]; ?></td>
      <td>
        <!-- Passing Variables Through URL To Be Able to fetch them with GET -->
         <a href="reopenedbugs.php?reOpen=<?php echo urlencode($row_value['id'])?>&reSub=<?php echo urlencode($row_value["bug_submitter"])
         ?>&reTitle=<?php echo urlencode($row_value["bug_title"])?>&reSeverity=<?php echo urlencode($row_value["bug_severity"])
         ?>&reDescription=<?php echo urlencode($row_value["bug_description"]); 
         ?>&dateSub=<?php echo urlencode($row_value["date_submitted"]) ?>"
         class="btn btn-warning">ReOpen</a>
         <a href="closed.php?close2=<?php echo $row_value['id']
         ?>&sub=<?php echo urlencode($row_value["bug_submitter"])
         ?>&title=<?php echo urlencode($row_value["bug_title"])
         ?>&severity=<?php echo urlencode($row_value["bug_severity"])
         ?>&description=<?php echo urlencode($row_value["bug_description"])?>"
         class="btn btn-success">close</a>
         
        
      </td>
    </tr>
      <?php endwhile; ?>
  </tbody>
</table>
  </div>
  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
    <!-- Table Displaying Re-Opened Bugs -->
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Bug Submitter</th>
      <th scope="col">Bug Title</th>
      <th scope="col">Severity</th>
      <th scope="col">Bug Description</th>
      <th scope="col">Date Submitted</th>
      <th scope="col">Date Re-Opened</th>
      <th scope="col">Re-Assign to</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody> 
     <?php while($values = mysqli_fetch_assoc($reOpenBugs)): ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
       <!-- Checking Severity -->
       <?php if($values["severity"] == "low") {
             $_SESSION["msg_type"] = "success";
} else if($values["severity"] == "moderate"){
             $_SESSION["msg_type"] = "primary";
} else if($values["severity"] == "major"){
             $_SESSION["msg_type"] = "warning";
} else if($values["severity"] == "critical"){
             $_SESSION["msg_type"] = "danger";
}

?>
    <input type="hidden"  name="re-id" value="<?php echo $values["id"]; ?>">
    <input type="hidden"  name="re-sub" value="<?php echo $values["bug_submitter"]; ?>">
    <input type="hidden"  name="re-title" value="<?php echo $values["bug_title"]; ?>">
    <input type="hidden"  name="re-severity" value="<?php echo $values["severity"]; ?>">
    <input type="hidden"  name="re-description" value="<?php echo $values["bug_description"]; ?>">
    <input type="hidden"  name="re-dateSub" value="<?php echo $values["date_submitted"]; ?>">
      <tr class="table-<?php echo $_SESSION["msg_type"]; ?>">
      <td><?php echo $values["bug_submitter"]; ?></td>
      <td><?php echo $values["bug_title"]; ?></td>
      <td><?php echo $values["severity"]; ?></td>
      <td><?php echo $values["bug_description"]; ?></td>
      <td><?php echo $values["date_submitted"]; ?></td>
      <td><?php echo $values["date_reopened"]; ?></td>
      <td>
      <select name="selectDev">
            <?php foreach($devList as $dev): ?>
            <option value="<?php echo $dev["username"] ?>"><?php echo $dev["username"] ?></option>
            <?php endforeach; ?>
       </select>
      </td>
      <td>
        <input name="re-assign" type="submit" value="Re-Assign" class="btn btn-<?php echo $_SESSION["msg_type"] ?>">
      </td>
    </tr>
      </form>
      <?php endwhile; ?>
  </tbody>
</table>
  </div>
    <a href="logout.php" class="btn btn-info ml-4">Logout</a>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>