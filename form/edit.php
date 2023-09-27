<?php
    include 'db_connection.php';
    // error_reporting(0); 
    $id = $_GET['id']; 
    print_r($_GET);
    $sql = "SELECT * FROM form WHERE id=".$id;
    $result = mysqli_query($conn,$sql); 
    $cust = $result->fetch_array(); 
//  print_r($cust);
    $data1 = $cust['hobby'];
    $data2 = explode(",",$data1);
//  print_r($data2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
</head>
<body style="background-color:lightgreen; text-align:center;"> 
    <!-- FORM TABLE HERE -->
    <form action="" method="post" style="text-align: center; background-color:lightgreen;" enctype="multipart/form-data">
        <h2>Edit Your Information</h2>

            <label>Preview: </label>
            <img src="<?php echo $cust['file_image'];?>" height="75px" width="75px">
        
        <br>
        <br>

        <label>Image: </label>
        <input type="file" name="uploadfile" value="<?php echo $cust['file_image'];?>" >
       
        <br>
        <br>
        
        <label for="fname">First Name: </label>
        <input type="text" name="fname" value="<?php echo $cust['first_name'];?>">
        
        <br>
        <br>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo $cust['last_name'];?>" >

        <br>
        <br>

        <label for="gender" value="" > Gender: </label>

        <input type="radio" name="gender" id="Male" value="Male"  
        <?php if($cust['gender'] == "Male"){echo "checked";}?>>Male


        <input type="radio" name="gender" id="Female" value="Female"
        <?php if($cust['gender']=="Female"){echo "checked";}?>>Female


        <input type="radio" name="gender" id="Transgender" value="Transgender"
        <?php if($cust['gender']=="Transgender"){echo "checked";}?>>Transgender


        <br>
        <br>

        <label for="city" name="city" value="">City: </label>

        <select name="city">

            <option value="" name="city" value="Select">Select</option>

            <option value="Surat" name="city" value="Surat"<?php if($cust['city']=="Surat"){echo "selected";}?>>Surat</option>

            <option value="Baroda" name="city" value="Baroda"<?php if($cust['city']=="Baroda"){echo "selected";}?>>Baroda</option>

            <option value="Rajkot" name="city" value="Rajkot"<?php if($cust['city']=="Rajkot"){echo "selected";}?>>Rajkot</option>

            <option value="Gandhinagar" name="city" value="Gandhinagar" <?php if($cust['city']=="Gandhinagar"){echo "selected";}?>>Gandhinagar</option>

        </select>    

        <br>
        <br>
 
        <label for="hobby" name="hobby" value="">Hobby: </label>

        <input type="checkbox" name="hobbies[]" value="Cricket" 
        <?php if(in_array("Cricket",$data2)){echo "checked";}?>>Cricket

        <input type="checkbox" name="hobbies[]" value="Music"
        <?php if(in_array("Music",$data2)){echo "checked";}?>> Music

        <input type="checkbox" name="hobbies[]" value="Online Games"
        <?php if(in_array("Online Games",$data2)){echo "checked";}?>> Online Games

        <input type="checkbox" name="hobbies[]" value="Movies"
        <?php if(in_array("Movies",$data2)){echo "checked";}?>> Movies

        <input type="checkbox" name="hobbies[]" value="Reading"
        <?php if(in_array("Reading",$data2)){echo "checked";}?>> Reading
        

        <br>
        <br>
    
 
        <button type="submit" name="update" value="update">Update</button>
       
    </form>
    <!-- PHP TABLE HERE -->
    <?php

            if(isset($_POST['update'])){

                // print "<pre>";
                // print_r($_POST);
                // die;

                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                $folder = "img/".$filename;
                move_uploaded_file($tempname,$folder);

                $new_image = $_FILES['$folder']['name'];
                $old_image = $_POST['uploadfile_old'];


                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $gender = $_POST['gender'];
                $city = $_POST['city'];
                $hobby = $_POST['hobbies'];
                $hobby1 = implode(",",$hobby);
                


            
            $sqli = "UPDATE form SET file_image='$folder', first_name='$fname', last_name='$lname', gender='$gender', city='$city', hobby='$hobby1' WHERE id='$id' "; 
            

    if(mysqli_query($conn,$sqli))
    {
        echo "New Record Updated";
        header('location:all.php?msg= Record Updated');
        ?>
        <META http-equiv="Refresh" content="0, url=http://localhost/Dev/form/newlist.php">
        <?php
    }
    else
    {
        echo "error: failed to update".mysqli_error($conn);
    }

}

?>
<br>
        <a href="all.php">
        <button>Go To List</button>
</body>
</html>