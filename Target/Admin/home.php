<?php
session_start();
// echo $_SESSION['randomString'];
include 'db_connect.php';
if (!isset($_SESSION['randomString'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="offcanvasWithBothOptions"><i class="bi bi-stack" style="font-size: 25px;"></i></button>
            <div class="mx-auto">
                <a class="navbar-brand" href="#">
                    <img src="img/logo.png" alt="Target logo" width="45px" height="65px">
                </a>
            </div>
            <button type="button" class="btn btn-outline-danger mx-2 my-2 my-lg-0" onclick="window.location.href='logout.php'">
                <i class="bi bi-door-closed" style="font-size: 25px;"></i> Logout
            </button>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebar">
        <div class="offcanvas-header ">
            <button type="button" class="btn-close text-reset float-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh;">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="home.php" class="nav-link" aria-current="page">
                            <i class="bi bi-house-door"></i>
                            HOME
                        </a>
                    </li>
                    <li>
                        <a href="category.php" class="nav-link">
                            <i class="bi bi-ui-checks-grid"></i>
                            CATEGORIES
                        </a>
                    </li>
                    <li>
                        <a href="products.php" class="nav-link">
                            <i class="bi bi-basket"></i>
                            PRODUCTS
                        </a>
                    </li>
                    <li>
                        <a href="orders.php" class="nav-link">
                            <i class="bi bi-box2"></i>
                            ORDERS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h2 class="text-center"> Welcome Admin User </h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            <br>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>