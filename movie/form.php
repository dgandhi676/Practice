<!-- DB Connection -->
<?php
include 'connectdb.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Movies Description
        </title>

<!-- JavaScript Code -->
<script>
function validateform() {
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
    <body style="background-color:lightgrey; text-align:center;">
    <form action="" method="post" enctype="multipart/form-data" id="movieform" style="text-align: center;
    background-color:lightgrey;" onsubmit="return validateform()">
            
        <br>
        <h1>
            Add Movie Information
        </h1>
        <br>

        <label for="movie_name">Movie Name: </label>
        <input type="text" name="movie_name" id="movie_name">

        <br>
        <br>

        <label for="movie_description">Description:</label>
        <textarea name="movie_description" id="movie_description" cols="30" rows="10"> </textarea>
        

        <br>
        <br>

        <label for="uploadposter">Poster: </label>
        <input type="file" name="uploadposter" id="uploadposter">

        <br>
        <br>
        
        <label for="genre" id="genre">Genre: </label>
        <p class="container">
            <input type="checkbox" name="genre[]" value="Romantic"> Romantic
            <input type="checkbox" name="genre[]" value="Action"> Action
            <input type="checkbox" name="genre[]" value="Comedy"> Comedy
        </p>

        <br>
        <br>

        <label for="adult" name="adult" >Adult: </label>

        <select name="adult" id="adult">
            <option value="" name="select" value="select">Select</option>
            <option value="Yes" name="adult">Yes</option>
            <option value="No" name="adult">No</option>
        </select>

        <br>
        <br>

        <label >Watched: </label>
        <p class="container">
        <input type="radio" name="watched" id="Yes" value="Yes">Yes
        <input type="radio" name="watched" id="No" value="No">No
        </p>

        <br>
        <br>

        <button type="submit" name="submit" value="Submit">
            Submit Movie

        </button>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
          
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
            
            $genre = $_POST['genre'];
            if(!empty($genre)){
                $genre1 = implode(",",$genre);
            }
            // print_r($genre1);
            // die;

            $adult = $_POST['adult'];
            $watched = $_POST['watched'];

            $sqli = "INSERT INTO movies (movie_name, movie_description, poster, genre, adult, watched) values 
            ('$movie_name', '$movie_description', '$folder1', '$genre1', '$adult', '$watched')";

            if(mysqli_query($conn,$sqli)){
                echo "Movie Record Inserted";
                header('location:list.php');
            }
            else
            {
                echo"error:".mysqli_error($conn);
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