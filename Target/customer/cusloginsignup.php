<?php
session_start();
include '../db_connect.php';

if (isset($_POST['signup'])) {
    $signupname = mysqli_real_escape_string($conn, $_POST['signupname']);
    $signupaddress = mysqli_real_escape_string($conn, $_POST['signupaddress']);
    $signupemail = mysqli_real_escape_string($conn, $_POST['signupemail']);
    $signuppass = password_hash($_POST['signuppass'], PASSWORD_DEFAULT);
    // var_dump($signuppass);
    // die();

    $stmt = $conn->prepare("INSERT INTO customer_master (cus_name, cus_address, cus_email, cus_password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $signupname, $signupaddress, $signupemail, $signuppass);

    if ($stmt->execute()) {
        header('Location: cusloginsignup.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
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
            background-image: url('../img/bgimg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex justify-content-center align-content-center">
            <a class="navbar-brand" href="cushome.php">
                <img src="../img/logo.png" class="" alt="Target logo" width="55px" height="65px">
            </a>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row justify-content-center align-items-center" style="height: 50vh;">
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
                        <br>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <form action="" method="post" id="loginform">
                                    <?php
                                    if (isset($_POST['login'])) {
                                        $loginemail = mysqli_real_escape_string($conn, $_POST["loginemail"]);
                                        $loginpass = $_POST["loginpass"];

                                        $stmt = $conn->prepare("SELECT cus_email, cus_password FROM customer_master WHERE cus_email=?");
                                        $stmt->bind_param("s", $loginemail);
                                        $stmt->execute();
                                        $stmt->bind_result($db_email, $db_password_hash);
                                        $stmt->fetch();

                                        if (password_verify($loginpass, $db_password_hash)) {
                                            $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 20);
                                            $_SESSION['randomString'] = $randomString;
                                            $_SESSION["customerEmail"] = $loginemail;
                                            $stmt->close();
                                            header("Location: checkout.php");
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
                                        devgandhi1113@gmail.com
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="password" class="form-control" id="loginpass" name="loginpass" placeholder="Enter your Password">
                                        <label for="loginPass" class="form-label">Password</label>
                                        Admin@123
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary px-3" name="login" id="login">Login</button>
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