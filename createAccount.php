<?php 
 
 // This is the Create Account Page



 $testing = "";
 $user_value = "";

// linking connection
require_once("database.php");

   
     if(isset($_POST["submit"])){
     // Sanitizing Inputs
     $userName = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
     $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
     $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS);

     // Securing Passwords
     $secure_pass = password_hash($password, PASSWORD_BCRYPT);

     // Checking the user account Type
     if($_POST["select"] == "user"){
          $user_value = "user";
     } else if($_POST["select"] == "developer"){
          $user_value = "developer";
     } else if($_POST["select"] == "admin"){
          $user_value = "admin";
     }


     // Checking if an Admin already exists in the database
     $sqlCheck = "SELECT * FROM users WHERE user_type = 'admin' ";
     $AdminQuery = mysqli_query($conn,$sqlCheck);
     $testing = mysqli_fetch_assoc(($AdminQuery));
      
     if($testing["user_type"] == "admin" && $user_value == "admin"){
          $_SESSION["message"] = "An Admin Account already exists";
          $_SESSION["msg_type"] = "danger";
          $_SESSION["checker"] = false;
     } else{
           $_SESSION["checker"] = true;
     }


     // Checking if the password is the same in both fields
     if($password !== $confirm_password){
         $_SESSION["message"] = "Password must be the same";
         $_SESSION["msg_type"] = "danger";
     } else if($password == $confirm_password){
     // Checking if a username already exists in the database
      $sqlString = "SELECT username FROM users WHERE username = '$userName' ";
      $usernameQuery = mysqli_query($conn,$sqlString);
       if(mysqli_num_rows($usernameQuery) > 0){
         $_SESSION["message"] = "Username already exists";
         $_SESSION["msg_type"] = "danger";
      }
        else if($_SESSION["checker"] == true) {
         // Inserting values into the database
         $sqlInsert = "INSERT INTO users (username,password,user_type) VALUES ('$userName','$secure_pass','$user_value') ";
         mysqli_query($conn,$sqlInsert);

         header("location: login.php");
         
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
      <div class=" mb-4 text-center alert alert-<?php echo $_SESSION["msg_type"] ?>">
        <?php echo $_SESSION["message"]; ?>
</div>
   <div class="container mr-4">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mt-4 ml-5 w-75">
        <h1 class="text-center">Create An Account</h1>
        <div class="mb-3">
        <label for="username" class="form-label">Create Username:</label>
        <input id="username" class="form-control" name="username" type="text" placeholder="Username" required>
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Create Password:</label>
        <input id="password" class="form-control" name="password" type="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
        <label for="rePassword" class="form-label">Confirm Password:</label>
        <input id="rePassword" class="form-control" name="confirm_password" type="password" placeholder="Confirm Password" required>
        </div>
        <div class="mb-3">
            <label for="dropdown">Select User Account Type:</label>
        <select id="dropdown" name="select" class="form-select form-control" aria-label="Default select example">
         <option value="user" name="user">User</option>
         <option value="developer" name="developer">Developer</option>
         <option value="admin" name="admin">Admin</option>
      </select>
        </div>
        <div class="mb-3">
        <input name="submit" type="submit" value="Create" class="btn btn-primary">
         <a href="index.php" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>