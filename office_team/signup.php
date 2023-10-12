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

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="empdata.php" method="post" id="loginform" onsubmit="return validateForm()" class="needs-validation" novalidate>
                                <h2 class="mb-5">Sign Up</h2>
                                
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email Address"/>
                                    <label for="email">Email Address</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="User Name" required />
                                    <label for="username">User Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" required />
                                    <label for="password">Password</label>
                                </div>

                                <div class="form-floating">
                                    <input type="password" class="form-control form-control-lg" name="conpassword" id="conpassword" placeholder="Confirm Password"/>
                                    <label for="conpassword">Confirm Password</label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block px-5 my-5" type="submit" value="login">Sign Up</button>

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
    </section>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="loginscript.js"></script>
</body>

</html>