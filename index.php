<?php

// This is the Home Page


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      
    <title>My Bug Tracker</title>
</head>
<body>
     <!-- NavBar -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
       <h5>Bug Tracker</h5>
      </nav>
    <div class="container">
        <div class="row justify-content-center mt-4">
             <h1>Bug Tracker App</h1>
        </div>
        <div class="row justify-content-center mt-4">
        <h4>User Accounts Can Only Submit Bugs</h4>
       </div>
        <div class="row justify-content-center mt-4">
        <h4>Developer Accounts Can Only Resolve Bugs</h4>
        </div>
        <div class="row justify-content-center mt-4">
        <h4>Admin Account Can Only Assign Bugs</h4>
        </div>
        <div class="row justify-content-center mt-4">
        <h4>There Can Only be one Admin</h4>
        </div>
        
        <div class="row justify-content-center">
              <div class="column justify-content-center mt-4">
                <a href="createAccount.php" class="btn btn-dark mr-4">Signup</a>
              </div>
        </div>
        <div class="row justify-content-center mt-4">
        <a href="login.php" class="ml-4">Already have an account? Click here</a>
        </div>

    </div>
</body>
</html>