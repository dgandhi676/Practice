<?php
include 'connectdb.php';
$sql = "SELECT * FROM movies";
$run1 = mysqli_query($conn,$sql);  
?>

<html>
    <head>
        <title>
            Movie Database
        </title>
    </head>
    <body style="background-color:darkgrey; text-align:center;">  
        <table border="3" cellspacing="4" cellpading="5" style="background-color:lightgrey; text-align:center;">
            <br>
            <th colspan="9">
                <br>
                <br>
            <?php if(isset($_GET['msg']) && !empty($_GET['msg'])){ 
               echo '<p class="myMsg">'.$_GET['msg'].'</p>';}?>
                <h2>Movie Record</h2>
                <a href="form.php">
                    <button>
                        ADD RECORD
                    </button>
                    <br>    
                </a>
            <br>
            </th>
            <tr class="heading">

                <th>
                    MOVIE ID
                </th>
                <th>
                    MOVIE NAME
                </th>
                <th>
                    MOVIE DESCRIPTION
                </th>
                <th>
                    MOVIE POSTER
                </th>
                <th>
                    GENRE
                </th>
                <th>
                    ADULT
                </th>
                <th>
                    WATCHED
                </th>
                <th colspan="2">
                    ACTION
                </th>
                
            </tr>
            </tr>
           <tr conspan="9">
                <?php 
                if ($num1 = mysqli_num_rows($run1)>0) {} 
                else 
                {
                    echo "Sorry No Records Found..";
                } 
               ?>
            </tr>
            <?php
            $i=1;
            if ($num1 = mysqli_num_rows($run1)>0) {
                while ($result = mysqli_fetch_assoc($run1)) {
                    echo "
                    <tr>
                    <td>".$result['movie_id']."</td>             
                    <td>".$result['movie_name']."</td>  
                    <td>".$result['movie_description']."</td>  
                    <td><img src='".$result['poster']."' height='150px' width='150px'></td>  
                    <td>".$result['genre']."</td>  
                    <td>".$result['adult']."</td> 
                    <td>".$result['watched']."</td> 
  
                    <td><button><a href = 'edit.php?id=".$result['movie_id']."'>EDIT
                    </a></button></td> 

                    <td><button><a href = 'delete.php?id=".$result['movie_id']."' id='btn'>DELETE</a></button></td>
                    </tr>";
                }
            }
            ?>
            </table>
        </body>
        </html>