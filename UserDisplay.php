<?php

// This Page is for Users to see the bugs they have submitted and status e.g (open,resolved, reOpen, Closed);


// Linking database
require_once("database.php");

// Adding Logged In Username to variable
$loggedInUser = $_SESSION["loggedInUser"];

// Displaying all Bugs Submitted by that username
$sqlSelect = "SELECT * FROM bugs WHERE bug_submitter = '$loggedInUser' ";
$results = mysqli_query($conn,$sqlSelect);


// Displaying All Resolved Bugs
$sql = "SELECT * FROM closedbugs WHERE bug_submitter = '$loggedInUser' ";
$closed_bugs = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Bootstrap CDN -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>User Submitted Bugs</title>
</head>
<body>
  <!-- NavBar -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
       <h5>Bug Tracker</h5>
      </nav>
     <h1 class="text-center"><?php echo $loggedInUser . "'s" . " Bugs" ?></h1>
      <h2 class="text-center">Bugs Submitted</h2>
     <!-- Showing User Submitted bugs -->
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Bug Submitter</th>
      <th scope="col">Bug Title</th>
      <th scope="col">Severity</th>
      <th scope="col">Description</th>
      <th scope="col">Date Submitted</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = mysqli_fetch_assoc($results)): ?>
    <!-- Showing Colors according to bug severity -->
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
     <tr class="table-<?php echo $_SESSION["msg_type"]; ?>">
      <td><?php echo $row["bug_submitter"]; ?></td>
      <td><?php echo $row["bug_title"]; ?></td>
      <td><?php echo $row["severity"]; ?></td>
      <td><?php echo $row["bug_description"]; ?></td>
      <td><?php echo $row["date"]; ?></td>
      <td>
     </tr>
  </tbody>
  <?php endwhile; ?>
     </table>
     <h2 class="text-center">Bugs Resolved</h2>
     <!-- Showing User Resolved Bugs -->
     <table class="table table-striped">
     <thead>
    <tr>
      <th scope="col">Bug Submitter</th>
      <th scope="col">Bug Title </th>
      <th scope="col">Severity </th>
      <th scope="col">Description</th>
      <th scope="col">Date Resolved</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
       <?php while($closed = mysqli_fetch_assoc($closed_bugs)): ?>
        <!-- Showing Colors According to bug severity -->
        <?php if($closed["severity"] == "low") {
              $_SESSION["msg_type"] = "success";
 } else if($closed["severity"] == "moderate"){
              $_SESSION["msg_type"] = "primary";
 } else if($closed["severity"] == "major"){
              $_SESSION["msg_type"] = "warning";
 } else if($closed["severity"] == "critical"){
              $_SESSION["msg_type"] = "danger";
 }  ?>
       <tr class="table-<?php echo $_SESSION["msg_type"]; ?>">
           <td><?php echo $closed["bug_submitter"]; ?></td>
           <td><?php echo $closed["bug_title"]; ?></td>
           <td><?php echo $closed["severity"]; ?></td>
           <td><?php echo $closed["bug_description"]; ?></td>
           <td><?php echo $closed["date_closed"]; ?></td>
           <td>
              <a href="delete.php?delete=<?php echo urlencode($closed["id"]);?>"
              class="btn btn-danger">Delete</a>
           </td>
       </tr>
  </tbody>
  <?php endwhile; ?>
</table>
     <a href="submitbugs.php" class="btn btn-warning">Back</a>
</body>
</html>