<?php
include 'db_connect.php';
if (isset($_POST['submit'])) {
    // print_r($_POST);
    // die();
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
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    //    print_r ($city) ;
    //    die();
    $complete = $_POST['complete'];
    if (!empty($complete)) {
        $complete5 = implode(",", $complete);
    }
    // echo $empcomplete5;
    // die;
    $profiledes = mysqli_real_escape_string($conn, $_POST['profiledes']);

    $sqli = "INSERT INTO employee (ot_firstname, ot_lastname, ot_phoneno, ot_dob, ot_image, ot_email, ot_gender, ot_country, ot_state, ot_city, ot_completed_5_years, ot_profile) values ('$fname', '$lname', '$monumber', '$dob', '$folder1', '$email', '$gender', '$country', '$state', '$city', '$complete5', '$profiledes')";
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
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center " style="min-height: 100vh;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-start">Add Team Member
                        <a href="empdata.php" class="btn btn-primary float-end ">Employee List</a>
                    </h2>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="teamform" enctype="multipart/form-data" onsubmit="return validateForm()" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp" placeholder="Enter your first Name">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="lname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp" placeholder="Enter your last Name">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="monumber" class="form-label">Mobile Number:</label>
                                <input type="tel" id="monumber" class="form-control" name="monumber" aria-describedby="monumberHelp" placeholder="Enter Your Phone Number" maxlength="10" minlength="10">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" placeholder="Select Your Birth Date." max="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="empimg" class="form-label">Upload Image:</label>
                                <input class="form-control" type="file" accept="image/png, image/gif, image/jpeg, image/jpg" id="empimg" name="empimg" onchange="validateImageSize(this)">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>
                            <br>
                            <div class="col-mb-3">
                                <label class="form-label" name="gender" value="gender" id="gender">Gender:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
                                    <label class="form-check-label" for="Male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
                                    <label class="form-check-label" for="Female">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-4">
                                <label for="country" class="form-label">Select Country:</label>
                                <select class="form-select country" id="country" name="country" onchange="loadStates()">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                            <br>
                            <div class="col-md-4">
                                <label for="state" class="form-label">Select State:</label>
                                <select class="form-select state" id="state" name="state" onchange="loadCities()">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            <br>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Select City:</label>
                                <select class="form-select city" id="city" name="city">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                            <br>
                            <div class="col-mb-3">
                                <label class="form-label" name="complete" value="complete" id="complete">5 Years Completed:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="complete[]" value="Yes" id="Yes" required>
                                    <label class="form-check-label" for="Yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="complete[]" value="No" id="No" required>
                                    <label class="form-check-label" for="No">
                                        No
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-md" name="profiledes" id="profiledes" style="height: 100px;"></textarea>
                                    <label for="profiledes" name="profiledes" id="profiledes" value="profiledes">Profile Description:</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-12">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit Details</button>
                        </div>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="script.js"></script>
</body>
</html>