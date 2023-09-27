<?php
include 'add_form.php';

if (isset($_GET['id'])) {  
    $id = $_GET['id'];

    $selectQuery = "SELECT file_image FROM `form` WHERE id = '$id'";
    $result = mysqli_query($conn, $selectQuery);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row['file_image'];

        if (unlink($imagePath)) {
            $deleteQuery = "DELETE FROM `form` WHERE id = '$id'";
            $run = mysqli_query($conn, $deleteQuery);
            
            if ($run) {
                header('location:newlist.php?msg=Record Deleted');  
            } else {
                echo "Error deleting record: " . mysqli_error($conn);  
            }
        } else {
            echo "Error deleting image file.";
        }
    } else {
        echo "Image not found.";
    }
}  
?>