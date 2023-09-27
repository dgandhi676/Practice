<!-- PHP DATABASE CONNECTION -->
<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Registration Form
    </title>

    <!-- CDN LINK jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

    <!-- Jquery -->
<script>
    jQuery(document).ready(function () {
        $("#form").validate({
            rules: {
                fname: "required",

                lname: "required",

                gender: {
                    required:true
                },

                city: "required",

                "hobbies[]": {
                    required: true
                },
            },
            messages: {
                fname: "This field is required",
                lname: " This field is required",

                gender: {
                    required: 'Please select a gender.'
                },

                city: " Please select the city",

                "hobbies[]": {
                    required: 'Please Select at least one hobby.'
                },
            },
            errorPlacement: function(error, element)
            { 
                if ( element.is(":radio , :checkbox") )
                {
                    error.appendTo( element.parents('.container') );
                }
                else 
                { 
                    // This is the default behavior 
                    error.insertAfter( element );
                }
            }

        });
        $('submit').on('click', function () {
            console.log($('form').valid());
        });
        $(function() {
            $('#uploadfile').checkFileType({
                allowedExtensions: ['jpg', 'jpeg','png'],
                success: function() {
                    alert('Success');
                },
                error: function() 
                {
                    alert('Error');
                }
            })
        });
    });
        </script>
</head>
<body style="background-color:lightgreen; text-align:center;">
    <!-- FORM TABLE HERE -->
    <form action="" method="post" style="text-align: center; background-color:lightgreen;" enctype="multipart/form-data" id="form">
  <br>
  <h2>Add Your Information</h2>
  <br>

  <label>Image: </label>
  <input type="file" name="uploadfile">
  <br>
  <br>

  <label for="fname">First Name: </label>
  <input type="text" name="fname">

  <br>
  <br>

  <label for="lname">Last Name:</label>
  <input type="text" name="lname">

  <br>
  <br>

  <label for="gender" name="gender1" id="gender1" > Gender: </label>
  <p class="container">
  <input type="radio" name="gender" id="gender" value="Male">Male
  <input type="radio" name="gender" id="gender" value="Female">Female
  <input type="radio" name="gender" id="gender" value="Transgender">Transgender
  </p>
  <br>
  <br>

  <label for="city" name="city">City: </label>

  <select name="city" id="city">
    <option value="" name="city" value="Select">Select</option>
    <option value="Surat" name="city" value="Surat">Surat</option>
    <option value="Baroda" name="city" value="Baroda">Baroda</option>
    <option value="Rajkot" name="city" value="Rajkot">Rajkot</option>
    <option value="Gandhinagar" name="city" value="Gandhinagar">Gandhinagar</option>
  </select>
  <br>

  <br>
  <br>

  <label for="hobby" name="hobby" id="hobby">Hobby: </label>
  <p class="container">
  <input type="checkbox" name="hobbies[]" value="Cricket">Cricket
  <input type="checkbox" name="hobbies[]" value="Music"> Music
  <input type="checkbox" name="hobbies[]" value="Online Games"> Online Games
  <input type="checkbox" name="hobbies[]" value="Movies"> Movies
  <input type="checkbox" name="hobbies[]" value="Reading"> Reading          
  </p>
  <br>
  <br>

  <br>

  <button type="submit" name="submit" id="submit">submit</button>

</form>
        
    <!-- PHP TABLE HERE -->
    <?php
            if(isset($_POST['submit']))
            {    
                 
                $filename = $_FILES["uploadfile"]["name"];
                $tempname = $_FILES["uploadfile"]["tmp_name"];
                $folder = "img/".$filename;
                move_uploaded_file($tempname,$folder);
                

                $fname = $_POST['fname']; 
                $lname = $_POST['lname'];
                $gender = $_POST['gender'];
                $city = $_POST['city'];

                $hobby = $_POST['hobby'];
                if (!empty($hobby)) {
                    $hobby1 = implode(",",$hobby);
                }
            //     INSERT QUERY
             
            $sqli = "INSERT INTO form (file_image,first_name, last_name, gender, city, hobby) values  ('$folder','$fname', '$lname', '$gender', '$city','$hobby1')"; 

    if(mysqli_query($conn,$sqli))
    {
        echo "New Record Inserted";
        header('location:newlist.php?msg= New Record Added');

        ?>
        <META http-equiv="Refresh" content="0, url=http://localhost/Dev/form/newlist.php">
        <?php
    }
    else
    {
        echo "error:".mysqli_error($conn);
    }
}

?>
<br>
  
    <a href="newlist.php">
    <button>Go To List</button>

</body>
</html>