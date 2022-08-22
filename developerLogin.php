<?php

// This is the developer login page

// linking to database
require_once("database.php");


$loggedInDeveloper = $_SESSION["loggedInUser"];


// Displaying all Bugs Assigned to that developer
$sqlSelect = "SELECT * FROM assigned_bugs WHERE developer_assigned = '$loggedInDeveloper' ";
$results = mysqli_query($conn,$sqlSelect);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Developer Login</title>
</head>
<body>
  <!-- NavBar -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
       <h5>Bug Tracker</h5>
      </nav>
      <h1 class="text-center"><?php echo "Developer " . $loggedInDeveloper . "'s " . "Login" ?></h1>
      <h2 class="text-center">Bugs Assigned</h2>
       <!-- Showing Bugs assigned to developer -->
       <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Bug Submitter</th>
      <th scope="col">Bug Title</th>
      <th scope="col">Severity</th>
      <th scope="col">Description</th>
      <th scope="col">Date Submitted</th>
      <th scope="col">Date Assigned</th>
      <th scope="col">Action</th>
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
      <td><?php echo $row["submitter"]; ?></td>
      <td><?php echo $row["title"]; ?></td>
      <td><?php echo $row["severity"]; ?></td>
      <td><?php echo $row["description"]; ?></td>
      <td><?php echo $row["date_submitted"]; ?></td>
      <td><?php echo $row["date_assigned"]; ?></td>
      <td>
          <a href="resolvedbugs.php?resolve=<?php echo urlencode($row["id"]) 
          ?>&sub=<?php echo urlencode($row["submitter"]) 
          ?>&title=<?php echo urlencode($row["title"]) 
          ?>&severity=<?php echo urlencode($row["severity"]) 
          ?>&description=<?php echo urlencode($row["description"]) 
          ?>&dateSub=<?php echo urlencode($row["date_submitted"])
          ?>&resolvedBy=<?php echo urlencode($row["developer_assigned"])?>" class="btn btn-<?php echo $_SESSION["msg_type"] ?>">Resolve</a>
      </td>
      <td>
     </tr>
  </tbody>
  <?php endwhile; ?>
     </table>
      <a href="logout.php" class="btn btn-info ml-4">Logout</a>
</body>
</html>