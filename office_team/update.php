<?php
include 'db_connect.php';
// error_reporting(0);
$id = $_GET['id'];
// print_r($id);
$sql = "SELECT * FROM employee WHERE ot_id = " . $id;
$result = mysqli_query($conn, $sql);
$fet = $result->fetch_array();
// print_r($fet);
$data = $fet['ot_completed_5_years'];
$data1 = explode(",", $data);
// print_r($data1);
if (isset($_POST['update'])) {


    $fname = $_POST['fname'];
    $lname = $_POST['lname'];



    $imgname = $_FILES['empimg']['name'];
    $tempname = $_FILES['empimg']['tmp_name'];
    $folder1 = "emp-image/" . $imgname;
    move_uploaded_file($tempname, $folder1);

    if (file_exists($folder1)) {
        $path_parts = pathinfo($folder1);
        if (isset($path_parts['extension'])) {
            $timestamp = time();
            $new_filename = $path_parts['filename'] . '_' . $timestamp . '.' . $path_parts['extension'];
            $new_folder1 = "emp-image/" . $new_filename;
            if (rename($folder1, $new_folder1)) {
                $folder1 = $new_folder1;
            }
        }
    }


    $email = $_POST['email'];
    $gender = $_POST['gender'];


    $complete = $_POST['complete'];
    if (!empty($complete)) {
        $complete5 = implode(",", $complete);
    }

    $profiledes = $_POST['profiledes'];

    $sqli = "UPDATE employee SET ot_firstname='$fname', ot_lastname='$lname', ot_image='$folder1', ot_email='$email', ot_gender='$gender', ot_completed_5_years='$complete5', ot_profile='$profiledes' WHERE ot_id='$id' ";

    if (mysqli_query($conn, $sqli)) {
        echo "Record Updated222";
        header('Location: empdata.php?msg= New Record Added', true);
        exit;
    } else {
        echo "error: failed to Update" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Member</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function validateform() {
            let a = document.forms['teamform']['fname'].value;
            if (a == "") {
                alert("Employee First Name is Empty!!");
                return false;
            }
            let b = document.forms['teamform']['lname'].value;
            if (b == "") {
                alert("Employee Last Name is Empty!!");
                return false;
            }
            let c = document.getElementById("empimg");
            let j = c.value;
            let allowesEx = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowesEx.test(j)) {
                alert("Please Upload file having extensions .jpeg/.jpg/.png/.gif only. !!");
                c.value = '';
                return false;
            }
            let d = document.forms['teamform']['email'].value;
            if (d == "") {
                alert("Please Enter Your E-Mail!!!");
                return false;
            }
            let e = document.getElementById("Male").checked;
            let f = document.getElementById("Female").checked;
            if (!e && !f) {
                alert("Select a Gender");
                return false;
            }
            let g = document.querySelectorAll('input[name="complete[]"]:checked');
            if (g.length === 0) {
                alert("Select Atleast One Option");
                return false;
            }
            let h = document.forms["teamform"]["profiledes"].value;
            if (h == "") {
                alert("Please Enter Profile Description!!!");
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-header">
                        <h2 class="text-start">Update Member
                            <a href="empdata.php" class="btn btn-primary float-end">Employee List</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="teamform" enctype="multipart/form-data" onsubmit="return validateform()">

                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="fname" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp" value="<?php echo $fet['ot_firstname']; ?>">
                                    <div id="fnameHelp" class="form-text">Enter your first name.</div>
                                </div>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="lname" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp" value="<?php echo $fet['ot_lastname']; ?>">
                                    <div id="lnameHelp" class="form-text">Enter your last name.</div>
                                </div>
                            </div>

                            <br>

                            <div class="mb-3">
                                <label class="form-label">Preview:</label>
                                <img src="<?php echo $fet['ot_image']; ?>" class="img-thumbnail" alt="Image Preview" style="max-height: 125px; max-width: 125px;">
                            </div>

                            <br>


                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="empimg" class="form-label">Upload Image:</label>
                                    <input class="form-control" type="file" id="empimg" name="empimg" aria-describedby="empimgHelp" value="<?php echo $fet['ot_image']; ?>">
                                    <div id="empimgHelp" class="form-text">Choose an image to upload.</div>
                                </div>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="email" class="form-label">Email Address:</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo $fet['ot_email']; ?>">
                                </div>
                            </div>

                            <br>

                            <div class="mb-3">
                                <label class="form-label">Gender:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="Male" value="Male" <?php if ($fet['ot_gender'] == "Male") {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                                    <label class="form-check-label" for="Male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="Female" value="Female" <?php if ($fet['ot_gender'] == "Female") {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                                    <label class="form-check-label" for="Female">
                                        Female
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">5 Years Completed:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="complete[]" value="Yes" <?php if (in_array("Yes", $data1)) {
                                                                                                                        echo "checked";
                                                                                                                    } ?> id="Yes">
                                    <label class="form-check-label" for="Yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="complete[]" value="No" <?php if (in_array("No", $data1)) {
                                                                                                                        echo "checked";
                                                                                                                    } ?> id="No">
                                    <label class="form-check-label" for="No">
                                        No
                                    </label>
                                </div>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-floating">
                                        <textarea class="form-control form-control-lg" name="profiledes" id="profiledes" style="height: 100px;"><?php echo $fet['ot_profile']; ?></textarea>
                                        <label for="profiledes">Profile Description:</label>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <button type="submit" name="update" value="update" class="btn btn-primary"> Update Details </button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>