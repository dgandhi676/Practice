<?php
include 'connectdb.php';
// error_reporting(0);
$id = $_GET['id'];
// print_r($_GET);
$sql = "SELECT * FROM movies WHERE movie_id=".$id;
$result = mysqli_query($conn,$sql);  
$rev = $result ->fetch_array();
// print_r($rev);
$data = $rev['genre'];
$data1 = explode(",",$data);
print_r($data1);


?>
<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <title>
            Movie Updation Information
        </title>
    <!-- JavaScript Code -->
    <script>
    function validateform() 
    {
        let a = document.forms["movieform"]["movie_name"].value;
        if (a == "")
        {
            alert("Movie Name must be filled out");
            return false;
        }
        let b = document.forms["movieform"]["movie_description"].value;
        if (b == " ")
        {
            alert("Description must be filled out");
            return false;
        }
        let c = document.getElementById("uploadposter").value;
        if (c == "")
        {
            alert("Select a movie poster");
            return false;
        }
        let d = document.querySelectorAll('input[name="genre[]"]:checked');
        if (d.length === 0) 
        {
            alert('Please select at least one genre');
            return false;
        }
        let e = document.forms["movieform"]["adult"].value;
        if (e == "")
        {
            alert("Adult must be selected");
            return false;
        }
        let f = document.getElementById("Yes").checked;
        let g = document.getElementById("No").checked;
        if (!f && !g)
        {
            alert("Select a button");
            return false;
        }
    }
    </script>
    </head>
    <body style="background-color:darkgray; text-align:center;">
    <form action="" method="post" enctype="multipart/form-data" id="movieform" style="text-align: center;
    background-color:ligthgray;" onsubmit="return validateform()">
            
            <br>
            <h1>Movie Updation Information</h1>
            <br>
    
            <label>Name: </label>
            <input type="text" name="movie_name" value="<?php 
             echo $rev['movie_name'];
            ?>">
    
            <br>
            <br>
    
            <label>Description: </label>
            <textarea name="movie_description" id="movie_description" cols="30" rows="10" 
            value=""> <?php echo $rev['movie_description'];
            ?></textarea>
        
            <br>
            <br>

            <label>Preview: </label>
            <img src="<?php 
            echo $rev['poster'];
            ?>" height="100px" width="100px">

            <br>
            <br>
    
            <label>Poster: </label>
            <input type="file" name="uploadposter" id="<?php
             echo $rev['poster'];
            ?>">
    
            <br>
            <br>
    
            <label for="genre" name="genre" id="genre">Genre: </label>

            <input type="checkbox" name="genres[]" value="Romantic"<?php
            if(in_array("Romantic",$data1)){echo "checked";}
            ?>> Romantic
            
            <input type="checkbox" name="genres[]" value="Romantic"<?php 
            if(in_array("Action",$data1)){echo "checked";}
            ?>> Action
            
            <input type="checkbox" name="genres[]" value="Romantic"<?php 
            if(in_array("Comedy",$data1)){echo "checked";}
            ?>> Comedy
            <br>
            <br>
    
            <label for="adult" name="adult" >Adult: </label>
    
            <select name="adult" id="adult">

                <option value="" name="" value=""></option>

                <option value="Yes" name="adult"<?php 
                if($rev['adult']=="Yes"){echo "selected";}
                ?>>Yes</option>

                <option value="No" name="adult"<?php 
                if($rev['adult']=="No"){echo "selected";}
                ?>>No</option>

            </select>

            <br>
            <br>

            <label for="watched" name="watched"> Movie Watched: </label>

            <input type="radio" name="watched" id="watched" value="Yes"<?php 
            if($rev['watched'] == "Yes"){echo "checked";}
            ?>>Yes

            <input type="radio" name="watched" id="watched" value="No"<?php 
            if($rev['watched'] == "No"){echo "checked";}?>>No

            <br>
            <br>
    
            <button type="submit" name="update" id="update">update</button>

            </form>
            
            <?php

            if(isset($_POST['update'])){

                $movie_name = $_POST['movie_name'];

                $movie_description = $_POST['movie_description'];
    
    
                $postername = $_FILES['uploadposter']['name'];
                $tempname = $_FILES['uploadposter']['tmp_name'];
                $folder1 = "poster/".$postername;
                move_uploaded_file($tempname, $folder1);

                if (file_exists($folder1)) {
                    $path_parts = pathinfo($folder1);
                    $timestamp = time();
                    $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
                    $new_folder1 = "poster/" . $new_filename;
                    rename($folder1, $new_folder1);
                    $folder1 = $new_folder1;
                }
            
    

                $genre = $_POST['genres'];
                if(!empty($genre))
                {
                    $genre1 = implode(",",$genre);
                }
                
                
                $adult = $_POST['adult'];

                $watched = $_POST['watched'];
                


            
            $sqli = "UPDATE movies SET movie_name='$movie_name', movie_description='$movie_description', poster='$folder1', genre='$genre1', 
            adult='$adult', watched='$adult' WHERE movie_id='$id' "; 
            

    if(mysqli_query($conn,$sqli))
    {
        echo "New Record Updated";
        header('location:list.php?msg= Record Updated');
        
    }
    else
    {
        echo "error: failed to update".mysqli_error($conn);
    }

}

?>
<br>
<a href="list.php">
    <button>
        List
    </button>
</body>
</html>