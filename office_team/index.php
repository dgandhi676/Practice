<?php
include 'db_connect.php';
if (isset($_POST['submit'])) {
    // print_r($_POST);
    $fname = $_POST['fname'];
    //    echo "First Name : ".$empfname;
    $lname = $_POST['lname'];
    $monumber = $_POST['monumber'];
    $dob = $_POST['dob'];

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
    //    print_r ($gender);
    //    die;
    $complete = $_POST['complete'];
    if (!empty($complete)) {
        $complete5 = implode(",", $complete);
    }
    // echo $empcomplete5;
    // die;

    $profiledes = $_POST['profiledes'];

    $sqli = "INSERT INTO employee (ot_firstname, ot_lastname, ot_phoneno, ot_dob, ot_image, ot_email, ot_gender, ot_completed_5_years, ot_profile) values ('$fname', '$lname', '$monumber', '$dob', '$folder1', '$email', '$gender', '$complete5', '$profiledes')";

    if (mysqli_query($conn, $sqli)) {
        echo "ADDED EMPLOYEE RECORD";
        header('Location: http://localhost/Dev/office_team/empdata.php');
        die();
    } else {
        echo "error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-start">Add Team Member
                        <a href="empdata.php" class="btn btn-primary float-end ">Employee List</a>
                    </h2>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="teamform" enctype="multipart/form-data" onsubmit="return validateform()">

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="fname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp">
                                <div id="fnameHelp" class="form-text">Enter your first name.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="lname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp">
                                <div id="lnameHelp" class="form-text">Enter your last name.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="monumber" class="form-label">Mobile Number:</label>
                                <input type="tel" id="monumber" class="form-control" name="monumber" aria-describedby="monumberHelp" pattern="[0-9]{10}">
                                <div id="monumberHelp" class="form-text">Enter Your Phone Number.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-auto">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" aria-describedby="dobHelp">
                                <div id="dobHelp" class="form-text">Select Your Birth Date.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="empimg" class="form-label">Upload Image:</label>
                                <input class="form-control" type="file" id="empimg" name="empimg" aria-describedby="empimgHelp">
                                <div id="empimgHelp" class="form-text">Choose an image to upload.</div>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>
                        </div>

                        <br>

                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
                                <label class="form-check-label" for="Male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
                                <label class="form-check-label" for="Female">
                                    Female
                                </label>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="country" class="form-label">Select Country:</label>
                                <select class="selectpicker countrypicker" data-flag="true" ></select>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="state" class="form-label">State:</label>
                                <select class="selectpicker form-control" data-live-search="true" id="state" name="state" disabled>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="city" class="form-label">City:</label>
                                <select class="selectpicker form-control" data-live-search="true" id="city" name="city" disabled>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="mb-3">
                            <label class="form-label">5 Years Completed:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="complete[]" value="Yes" id="Yes">
                                <label class="form-check-label" for="Yes">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="complete[]" value="No" id="No">
                                <label class="form-check-label" for="No">
                                    No
                                </label>
                            </div>
                        </div>

                        <br>

                        <div class="row g-3">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-lg" name="profiledes" id="profiledes" style="height: 100px;"></textarea>
                                    <label for="profiledes">Profile Description:</label>
                                </div>
                            </div>
                        </div>
                        <br>

                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit
                            Details</button>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('.countrypicker').countrypicker();
    </script>
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
            0
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
</body>

</html>