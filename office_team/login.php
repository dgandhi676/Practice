<?php
session_start();
include "db_connect.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form action="" method="post" id="loginform">
                            <h2 class="mb-5">Sign in</h2>
                            <?php
                            if (isset($_POST['login'])) {
                                $username = $_POST["username"];
                                $password = $_POST["password"];
                                $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND user_password=?");
                                $stmt->bind_param("ss", $username, $password);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 20);
                                    $_SESSION['randomString'] = $randomString;
                                    $_SESSION['fullname'] = $row['fullname'];
                                    $_SESSION["user"] = $username;
                                    $_SESSION["login_time_stamp"] = time(); 
                                    header("Location: empdata.php");
                                    exit();
                                } else {
                            ?>
                                    <div class="alert alert-danger text-center">
                                        <h4 class="mb-0">Sorry, Invalid Username and Password</h4>
                                        <p class="mb-0">Please Enter Correct Credentials</p>
                                    </div>
                            <?php
                                }
                                $stmt->close();
                            }
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="User Name" required />
                                <label for="username">User Name</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" required />
                                <label for="password">Password</label>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block px-5 my-5" type="submit" value="login" name="login">Login</button>

                            <div>
                                <p class="mb-0">Don't have an account? <a href="signup.php" class="text-primary fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </form>
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