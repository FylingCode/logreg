<?php

$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  include "partials/db.php";

  $username = $_POST["username"];
  $password = $_POST["password"];


  if (empty($username) || empty($password)) {
    $showError = "Username and password cannot be empty!";
} else {
  

    //   $sql = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
    $sql = "SELECT * FROM `users` WHERE username='$username' ";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if($num == 1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login = true;
                session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          header("Location: welcome.php");
            }
            else{
                $showError = "Invalid Username And Password";
            }
            
        } 

      }else{
        $showError = "Invalid Username And Password";
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <?php
   include "partials/nav.php";
    ?>
<?php
if($login){
  echo '
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !!! </strong> Login successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
}

if ($showError) {
  echo '
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed !!! </strong> Login Unsuccessful,  ' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  ';
}

?>

   
        <div class="text-center container mt-5">
            <h2>Login</h2>
            <hr>
        </div>

        <form action="/logreg/login.php" method="post" class="container">
  <div class="mb-3">
    <label for="username" class="form-label">User Name</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
  <div class="my-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
 
  </div>
  <button type="submit" class="btn btn-primary">login</button>
</form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>