<?php

$showalert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  include "partials/db.php";

  $username = $_POST["username"];
  $password = $_POST["password"];
  $con_password = $_POST["con_password"];



  if (empty($username) || empty($password)) {
    $showError = "Username and password cannot be empty!";
} else {

  $exitssql = "SELECT * FROM users WHERE username = '$username'" ;
  $result = mysqli_query($conn, $exitssql);
  $numExistsRow = mysqli_num_rows($result);

  if($numExistsRow > 0){
    $showError = "User Name Already Exist";
  }else{
    if(($password == $con_password)){

      $hash = password_hash($password , PASSWORD_DEFAULT);

      $sql = "INSERT INTO `users` ( `username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";

      $result = mysqli_query($conn, $sql);

      if($result){
          $showalert = true;
      }

  }else{
    $showError = "Please Enter the Same Password  ";
  }

  }

 
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <?php
   include "partials/nav.php";
    ?>
<?php
if($showalert){
  echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !!! </strong> Registered successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
}

if ($showError) {
  echo '
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed !!! </strong> Registration Unsuccessful,  ' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  ';
}

?>

   
        <div class="text-center container mt-5">
            <h2>Register Youirself</h2>
            <hr>
        </div>

        <form action="/logreg/signup.php" method="post" class="container">
  <div class="mb-3">
    <label for="username" class="form-label">User Name</label>
    <input type="text" maxlength="30" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
  <div class="my-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" maxlength="20" class="form-control" id="password" name="password">
  </div>
  <!-- <div class="mb-3">
    <label for="con_password" class="form-label">Confrim Password</label>
    <input type="password" maxlength="20" class="form-control" id="con_password" name="con_password">
    <div id="passwordHelp" class="form-text">Type the Same Password</div>
  </div> -->
  <div class="mb-3">
    <label for="con_password" class="form-label">Confirm Password</label>
    <input type="password" maxlength="20" class="form-control" id="con_password" name="con_password" required>
    <div id="passwordHelp" class="form-text">Re-enter your password to confirm.</div>
</div>
  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>