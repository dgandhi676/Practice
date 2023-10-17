<?php
session_start();
include 'db_connect.php';
if (isset($_SESSION["user"])) {
    if (time() - $_SESSION["login_time_stamp"] > 600) {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
} else {
    header("Location:login.php");
}
if (!isset($_SESSION['randomString'])) {
    header("Location: login.php");
    exit();
}
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
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    // die();  
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $monumber = $_POST['monumber'];
    $dob = $_POST['dob'];
    if (!empty($_FILES['empimg']['name'])) {
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
    } else { 
        $folder1 =$_POST['hiddenimg'];
    }
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $complete = $_POST['complete'];
    if (!empty($complete)) {
        $complete5 = implode(",", $complete);
    }
    $profiledes = mysqli_real_escape_string($conn, $_POST['profiledes']);
    $sqli = "UPDATE employee SET ot_firstname='$fname', ot_lastname='$lname', ot_phoneno='$monumber', ot_dob='$dob', ot_image='$folder1', ot_email='$email', ot_gender='$gender', ot_country='$country', ot_state='$state', ot_city='$city', ot_completed_5_years='$complete5', ot_profile='$profiledes' WHERE ot_id='$id' ";
    if (mysqli_query($conn, $sqli)) {
        echo "Record Updated";
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-secondary">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-start">Update Member
                        <a href="empdata.php" class="btn btn-outline-primary float-end">Employee List</a>
                    </h2>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="teamform" enctype="multipart/form-data" onsubmit="return validateform()" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fnameHelp" value="<?php echo $fet['ot_firstname']; ?>">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="lname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lnameHelp" value="<?php echo $fet['ot_lastname']; ?>">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="monumber" class="form-label">Mobile Number:</label>
                                <input type="tel" id="monumber" class="form-control" name="monumber" aria-describedby="monumberHelp" placeholder="Enter Your Phone Number" maxlength="10" minlength="10" value="<?php echo $fet['ot_phoneno']; ?>">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" placeholder="Select Your Birth Date." max="<?php echo date('Y-m-d'); ?>" value="<?php echo $fet['ot_dob']; ?>">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label class="form-label">Preview:</label>
                                <img src="<?php echo $fet['ot_image']; ?>" class="img-thumbnail" alt="Image Preview" style="max-height: 125px; max-width: 125px;">
                            </div>
                            <input type="hidden" name="hiddenimg" id="hiddenimg" value="<?php echo $fet['ot_image']; ?>">
                            <br>
                            <div class="col-md-6">
                                <label for="empimg" class="form-label">Upload Image:</label>
                                <input class="form-control" type="file" accept="image/png, image/gif, image/jpeg, image/jpg" id="empimg" name="empimg" onchange="validateImageSize(this)" value="<?php echo $fet['ot_image']; ?>">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo $fet['ot_email']; ?>">
                            </div>
                            <br>
                            <div class="col-sm-6 my-5">
                                <label class="form-label" name="gender" value="gender" id="gender">Gender:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Male" value="Male" <?php if ($fet['ot_gender'] == "Male") {echo "checked";} ?>>
                                    <label class="form-check-label" for="Male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Female" value="Female" <?php if ($fet['ot_gender'] == "Female") {echo "checked";} ?>>
                                    <label class="form-check-label" for="Female">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <br>
                            <input type="hidden" name="hiddencountry" id="hiddencountry" value="<?php echo $fet['ot_country']; ?>">
                            <div class="col-md-4">
                                <label for="country" class="form-label">Select Country:</label>
                                <select class="form-select country" id="country" name="country" onchange="loadStates(true)"></select>
                            </div>
                            <br>
                            <input type="hidden" name="hiddenstate" id="hiddenstate" value="<?php echo $fet['ot_state']; ?>">
                            <div class="col-md-4">
                                <label for="state" class="form-label">Select State:</label>
                                <select class="form-select state" id="state" name="state" onchange="loadCities(true)"></select>
                            </div>
                            <br>
                            <input type="hidden" name="hiddencity" id="hiddencity" value="<?php echo $fet['ot_city']; ?>">
                            <div class="col-md-4">
                                <label for="city" class="form-label">Select City:</label>
                                <select class="form-select city" id="city" name="city"></select>
                            </div>
                            <br>
                            <div class="col-mb-3">
                                <label class="form-label" name="complete" value="complete" id="complete">5 Years Completed:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="complete[]" value="Yes" <?php if (in_array("Yes", $data1)) {echo "checked";} ?> id="Yes">
                                    <label class="form-check-label" for="Yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="complete[]" value="No" <?php if (in_array("No", $data1)) {echo "checked";} ?> id="No">
                                    <label class="form-check-label" for="No">
                                        No
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control form-control-md" name="profiledes" id="profiledes" style="height: 100px;"><?php echo $fet['ot_profile']; ?></textarea>
                                    <label for="profiledes" name="profiledes" id="profiledes" value="profiledes">Profile Description:</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" name="update" value="update" class="btn btn-outline-primary"> Update Details </button>
                    </form>
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
        <script type="text/javascript" src="updatescript.js"></script>
</body>

</html>