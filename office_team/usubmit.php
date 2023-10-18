<?php
include "db_connect.php";

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $checkUsernameQuery);
    // echo mysqli_num_rows($result);

    if (mysqli_num_rows($result) > 0) {
        echo 'exists';
        exit;       
    } else {
        echo 'available';
    }
}  
?>