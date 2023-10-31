<?php
session_start();
include 'db_connect.php';
if (isset($_POST['signup'])) {
    echo "<pre>";
    print_r($_POST);
    die();
    $signupname = $_POST['signupname'];
    $signupaddress =  mysqli_real_escape_string($conn, $_POST['signupaddress']);
    $signupemail = $_POST['signupemail'];
    $signuppass = $_POST['signuppass'];


    $sqli = "INSERT INTO customer_master (cus_name, cus_address, cus_email, cus_password) values ('$signupname', '$signupaddress', '$signupemail', '$signuppass')";

    if (mysqli_query($conn, $sqli)) {
        header('Location: cusloginsignup.php');
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
    <title>Login/SignUp</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-image: url('img/bgimg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="cushome.php">
                <img src="img/logo.png" alt="Target logo" width="55px" height="65px">
            </a>
            <h2 class="navbar text-center">Target</h2>
            <button type="button" class="btn btn-outline-danger mx-2 my-2 my-lg-0 d-flex align-items-center" onclick="window.location.href='cusloginsignup.php'">
                Login/Signup
            </button>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center" style="height: 75vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="login-tab" data-bs-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="signup-tab" data-bs-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign Up</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <form action="" method="post" id="loginform">
                                    <?php
                                    if (isset($_POST['login'])) {
                                        $loginemail = $_POST["loginemail"];
                                        $loginpass = $_POST["loginpass"];
                                        $stmt = $conn->prepare("SELECT * FROM customer_master WHERE cus_email=? AND cus_password=?");
                                        $stmt->bind_param("ss", $loginemail, $loginpass);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 20);
                                            $_SESSION['randomString'] = $randomString;
                                            $_SESSION["email"] = $loginemail;
                                            $stmt->close();
                                            header("Location: home.php");
                                            exit();
                                        } else {
                                            echo '<div class="alert alert-danger text-center">
                                            <h4 class="mb-0">Sorry, Invalid Email and Password</h4>
                                            <p class="mb-0">Please Enter Correct Credentials</p></div>';
                                            $stmt->close();
                                        }
                                    }
                                    ?>
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="loginemail" name="loginemail" placeholder="Enter your Email">
                                        <label for="loginemail" class="form-label">Email:</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="password" class="form-control" id="loginpass" placeholder="Enter your Password">
                                        <label for="loginPass" class="form-label">Password</label>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary px-3">Sign In</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                                <form action="" method="post" id="signupform" onsubmit="return validateform()" class="needs-validation" novalidate>
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="signupname" name="signupname" placeholder="Write your Name">
                                        <label for="signupname" class="form-label">Name:</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <textarea class="form-control form-control-md" name="signupaddress" id="signupaddress" placeholder="Enter Address"></textarea>
                                        <label for="signupaddress" class="form-label">Address:</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" id="signupemail" name="signupemail" me placeholder="Enter your email address">
                                        <label for="signupemail" class="form-label">Email Address:</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="password" class="form-control" id="signuppass" name="signuppass" placeholder="Create your password">
                                        <label for="signuppass" class="form-label">Password:</label>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary" name="signup" id="signup">Sign Up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>