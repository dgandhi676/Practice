<?php
include 'connectdb.php';

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM movies WHERE movie_id=$id LIMIT 1");

if ($row = mysqli_fetch_assoc($res)) {
    $deleteimage = $row['poster'];
}

$folder = "poster/";
if (!empty($deleteimage)) {
    unlink($folder . $deleteimage);
}

$result = mysqli_query($conn, "DELETE FROM movies WHERE movie_id=$id");

if ($result) {
    header("location:list.php");
    exit();
}
?>