<?php
session_start();
include "db_connect.php";
if (isset($_POST['submit'])) {
    echo "<pre>";
    print_r($_POST);
    die();
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqli = "INSERT INTO users (fullname, username, user_email, user_password) values ('$fullname', '$username', '$email', '$password')";

    if (mysqli_query($conn, $sqli)) {
        echo "ADDED EMPLOYEE";
        header('Location: login.php');
    } else {
        echo "error: " . mysqli_error($conn);
    }
}
if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($result) > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }

    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <form action="" method="post" id="loginform" onsubmit="return validateForm()" class="needs-validation" novalidate>
                            <h2 class="mb-5">Sign Up</h2>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-lg" name="fullname" id="fullname" placeholder="Full Name" />
                                <label for="fullname">Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="User Name" />
                                <label for="username">User Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email Address" />
                                <label for="email">Email Address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" />
                                <label for="password">Password</label>
                            </div>

                            <button class="btn btn-primary btn-lg btn-block px-5 my-5" type="submit" value="signup" name="submit">Sign Up</button>

                            <div>
                                <p class="mb-0">Already Account Created? <a href="login.php" class="text-primary fw-bold">Sign In</a>
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
    <!-- Custom scripts -->
    <script type="text/javascript">
        const nameRegex = /^[A-Za-z ]+$/;
        const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        const passRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

        function validateForm() {
            const fullname = document.forms["loginform"]["fullname"].value;
            const email = document.forms["loginform"]["email"].value;
            const username = document.forms["loginform"]["username"].value;
            const newPassword = document.getElementById("password").value;

            if (fullname === "" || !nameRegex.test(fullname)) {
                showTooltip("fullname", "Employee First Name should contain alphabets and spaces only!");
                return false;
            }

            if (username === "") {
                showTooltip("username", "Username cannot be empty.");
                return false;
            }

            if (!emailRegex.test(email)) {
                showTooltip(
                    "email",
                    "Please enter a valid email address (name@example.com)."
                );
                return false;
            }

            if (newPassword.length < 8 || newPassword.length > 16) {
                showTooltip("password", "Password should be between 8 to 16 characters.");
                return false;
            }

            if (!passRegex.test(newPassword)) {
                showTooltip(
                    "password",
                    "Password should contain at least one number and one special character."
                );
                return false;
            }

            return true;
        }

        function showTooltip(elementId, message) {
            const element = document.getElementById(elementId);
            const tooltip = new bootstrap.Tooltip(element, {
                title: message,
                trigger: "manual",
                placement: "bottom",
            });

            tooltip.show();
            setTimeout(() => {
                tooltip.hide();
            }, 2000);
        }

        document.getElementById("loginform").addEventListener("submit", function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });

        document
            .getElementById("fullname")
            .addEventListener("keypress", function(event) {
                const regex = /^[A-Za-z\s]+$/;
                const key = String.fromCharCode(event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                }
            });

            document.getElementById("username").addEventListener("input", function(event) {
                const username = event.target.value;
                if (username === "") {
                    showTooltip("username", "Username cannot be empty.");
                    return;
                }
                
                $.post("signup.php", { username: username }, function(data) {
                    if (data === "exists") {
                        var aa = showTooltip("username", "Username already exists.");
                        if (aa) {
                            event.preventDefault();
                        }
                    } else {
                        showTooltip("username", "");
                    }
                });
            });
    </script>
</body>

</html>