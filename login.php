<?php

// This is the login page

// linking to database
require_once("database.php");


 
  

if(isset($_POST["submit"])){
      // Sanitizing inputs
      $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  
      // Checking if user exists if not, displaying error message
      // If user exists and username and password match database username and password
      // Then user is able to login
      // checking username
      $sqlString = "SELECT username FROM users WHERE username = '$username' ";
      $usernameQuery = mysqli_query($conn,$sqlString);
      if(mysqli_num_rows($usernameQuery) == null){
         $_SESSION["message"] = "Username does not exist in database";
         $_SESSION["msg_type"] = "danger";
} 
      // checking password
      $sqlSelect = "SELECT password FROM users WHERE username = '$username' ";
      // Storing result in variable
      $result = mysqli_query($conn,$sqlSelect);
      // fetching result in an array
      while($row = mysqli_fetch_assoc($result)){
          if(password_verify($password, $row["password"])){     
            // Checking Account TYPE
           $sqlCheck = "SELECT user_type FROM users WHERE username = '$username' ";
           // storing result in variable
          $check_result = mysqli_query($conn, $sqlCheck);
         while($tbl_row = mysqli_fetch_assoc($check_result)){
        if($tbl_row["user_type"] == "admin"){
             header("Location: adminLogin.php");
        } else if($tbl_row["user_type"] == "user"){
            header("Location: submitbugs.php");
            session_start();
            $_SESSION["loggedInUser"] = $username;
        } else if($tbl_row["user_type"] == "developer"){
             header("Location: developerLogin.php");
             session_start();
             $_SESSION["loggedInUser"] = $username;
        }
      }   
             
          } else if($password !== $row["password"]){
              $_SESSION["message"] = "Password is incorrect";
              $_SESSION["msg_type"] = "danger";
          } 
      }

      
      

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
    <title>Create Account</title>
</head>
<body>
      <nav class="navbar navbar-expand-sm navbar-light bg-light">
       <h5>Bug Tracker</h5>
      </nav>
    <!-- Displaying Messages -->
      <div class="mb-4 text-center alert alert-<?php echo $_SESSION["msg_type"] ?>">
        <?php echo $_SESSION["message"]; ?>
    </div>
    <div class="container mr-4">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mt-4 ml-5 w-75">
        <h1 class="text-center">Login</h1>
        <div class="mb-4">
        <label for="username" class="form-label">Username:</label>
        <input id="username" class="form-control" name="username" type="text" placeholder="Enter Username" required>
        </div>
        <div class="mb-4">
        <label for="password" class="form-label">Password:</label>
        <input id="password" class="form-control" name="password" type="password" placeholder="Password" required>
        </div>
        <div class="mt-4">
        <input name="submit" type="submit" value="Login" class="btn btn-primary mr-2">
         <a href="index.php" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>