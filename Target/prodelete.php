<?php
include 'db_connect.php';

$id = $_GET['id'];
$del = mysqli_query($conn, "SELECT * FROM product_master WHERE pro_id=$id LIMIT 1");

if ($row = mysqli_fetch_assoc($del)) {
    $deleteimg = $row['pro_image'];
}

$result = mysqli_query($conn, "DELETE FROM product_master WHERE pro_id=$id");
$folder = "catimg/";
if(!empty($deleteimg)){
    unlink($folder.$deleteimg);
}


if ($result){
    header("location:products.php");
    exit();
}
?>