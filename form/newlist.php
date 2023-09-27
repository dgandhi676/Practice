<?php
include 'db_connection.php';
$sql = "SELECT  * , CONCAT(first_name,' ', last_name) AS first_name FROM form ORDER BY id DESC";
$run = mysqli_query($conn,$sql);
?>  


<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="utf-8">
          <title>
               Database List
          </title>
     </head>
     <body style="background-color:lightgreen; text-align:center;">
     <table border="1" cellspacing="3" cellpadding="2" style="background-color:lightgrey; text-align:center;">
     <th colspan="8">
          <?php if(isset($_GET['msg']) && !empty($_GET['msg'])){ 
               echo '<p class="myMsg">'.$_GET['msg'].'</p>';}?>
               <h2>FORM RECORD</h2>
               <a href="add_form.php">
                    <button>
                         ADD RECORD
                    </button>
               </a>
               <br>
          </th>
          <tr class="heading">

               <th>
                    ID
               </th>
               <th>
                    IMAGE
               </th>
               <th>
                    FULL NAME
               </th>
               <th>
                    GENDER
               </th>
               <th>
                    CITY
               </th>
               <th>
                    HOBBY
               </th>
               <th colspan="2">
                    ACTION
               </th>

          </tr>
          <tr colspan="8">
               <?php if ($num = mysqli_num_rows($run)>0) {} else 
               {
                    echo "Sorry No Records Found..";
               }
               ?>
          </tr>
          <?php 
          $i=1;
          if ($num = mysqli_num_rows($run)>0) {
               while ($result = mysqli_fetch_assoc($run)) { 
                    echo "
                    <tr>
                    <td>".$result['id']."</td>                     <td><img src='".$result['file_image']."' height='75px' width='75px'></td> 

                    <td>".$result['first_name']."</td>  
                    <td>".$result['gender']."</td>  
                    <td>".$result['city']."</td>  
                    <td>".$result['hobby']."</td> 
              
                    <td><button><a href = 'edit.php?id=".$result['id']."'>EDIT
                    </a></button></td>

                    <td><button><a href = 'delete.php?id=".$result['id']."' id='btn'>DELETE</a></button></td>
                    </tr>";
               }
          }
          ?>
          </table>
     </body>
     </html>  