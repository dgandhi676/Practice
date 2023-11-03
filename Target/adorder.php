<?php
session_start();
include 'db_connect.php';
// echo $_SESSION['randomString'];

if (!isset($_SESSION['randomString'])) {
    header("Location: login.php");
    exit();
}
$records_per_page = 6;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $records_per_page;
// $sql = "SELECT * FROM";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
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
                <a href="home.php" class="navbar-brand">
                    <img src="img/logo.png" alt="Target Logo" width="45px" height="65px">
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
                        <a href="adorder.php" class="nav-link">
                            <i class="bi bi-box2"></i>
                            ORDERS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>