<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_app";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
 //   return $conn;

// function CloseCon($conn)
// {
//     $conn -> close();
// }
?>
