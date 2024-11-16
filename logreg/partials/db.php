<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "users";


$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
//     echo "Database connection Succesfully";
// }else{
    die("Databse Connection Failed : " . mysqli_connect_error($conn));
}


?>