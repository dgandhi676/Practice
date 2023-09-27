<?php
include 'db_connect.php';

$id = $_GET['id'];
$del = mysqli_query($conn, "SELECT * FROM employee WHERE ot_id=$id LIMIT 1");

if ($row = mysqli_fetch_assoc($del)) {
    $deleteimg = $row['ot_image'];
}

$result = mysqli_query($conn, "DELETE FROM employee WHERE ot_id=$id");
$folder = "emp-image/";
if(!empty($deleteimg)){
    unlink($folder.$deleteimg);
}


if ($result){
    header("location:empdata.php");
    exit();
}
?>