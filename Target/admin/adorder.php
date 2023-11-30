<?php
session_start();
include '../db_connect.php';

if (!isset($_SESSION['adminRandomString'])) {
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

$sql = "SELECT * FROM order_product_master ORDER BY sr_no ASC LIMIT";
$run1 = mysqli_query($conn, $sql);
echo $run1;
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM order_product_master WHERE 
            sr_no LIKE '%$searchTerm%' OR 
            customer_name LIKE '%$searchTerm%' OR 
            amount_order LIKE '%$searchTerm%' OR
            date_order LIKE '%$searchTerm%'
            ORDER BY sr_no ASC LIMIT $offset, $records_per_page";
} else {

    $sql = "SELECT * FROM order_product_master ORDER BY sr_no ASC LIMIT $offset, $records_per_page";
}
$run1 = mysqli_query($conn, $sql);
$total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM order_product_master"));
$total_pages = ceil($total_records / $records_per_page);

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
                    <img src="../img/logo.png" alt="Target Logo" width="45px" height="65px">
                </a>
            </div>
            <button type="button" class="btn btn-outline-danger mx-2 my-2 my-lg-0" onclick="window.location.href='logout.php'">
                <i class="bi bi-door-closed" style="font-size: 15px;"></i> Logout
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
    <div class="container mt-4">
        <h3>Order Details</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Customer Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tr colspan="5">
                <?php
                if ($num1 = mysqli_num_rows($run1) > 0) {
                } else {
                    echo "<td colspan='6'><No class='text-center text-danger'>No Record Found!</p></td>";
                }
                ?>
            </tr>
            <tbody>
                <?php
                $i = 1;
                if ($num1 = mysqli_num_rows($run1) > 0) {
                    while ($result = mysqli_fetch_assoc($run1)) {
                        echo "
                    <tr>
                        <td>" . $result['sr_no'] . "</td>
                        <td>" . $result['customer_name'] . "</td>
                        <td>Rs." . $result['amount_order'] . " </td>
                        <td>" . $result['date_order'] . "</td>
                        <td><a href='order_view.php?id=" . $result['sr_no'] . "' class='btn btn-outline-primary'>View</a></td>
                    </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>