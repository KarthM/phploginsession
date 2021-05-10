<?php 

$server = "localhost:3307";
$user = "root";
$pass = "root";
$database = "loginout";

$conn = mysqli_connect($server, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
 
 
  ?>

