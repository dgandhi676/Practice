<?php
include 'db_connect.php';

$id = $_GET['id'];
$del = mysqli_query($conn, "SELECT * FROM category_master WHERE cat_id=$id LIMIT 1");

if ($row = mysqli_fetch_assoc($del)) {
    $deleteimg = $row['cat_image'];
}

$result = mysqli_query($conn, "DELETE FROM category_master WHERE cat_id=$id");
$folder = "catimg/";
if(!empty($deleteimg)){
    unlink($folder.$deleteimg);
}


if ($result){
    header("location:category.php");
    exit();
}
?>