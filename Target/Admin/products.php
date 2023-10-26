<?php
session_start();
include 'db_connect.php';
// echo $_SESSION['randomString'];

if (!isset($_SESSION['randomString'])) {
    header("Location: login.php");
    exit();
}
// Pagination Query
$records_per_page = 5;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $records_per_page;
// Search Query
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM product_master WHERE 
            pro_name LIKE '%$searchTerm%' OR 
            pro_image LIKE '%$searchTerm%' OR             
            pro_sellprice LIKE '%$searchTerm%' OR
            pro_discprice LIKE '%$searchTerm%'
            ORDER BY pro_id ASC LIMIT $offset, $records_per_page";
} else {
    $sql = "SELECT * FROM product_master ORDER BY pro_id ASC LIMIT $offset, $records_per_page";
}
$run1 = mysqli_query($conn, $sql);
$total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product_master"));
$total_pages = ceil($total_records / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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

    <h1 class="bg-primary-subtle text-bg-info text-center py-3 px-5">
        Products List
        <a href="productsadd.php" class="btn btn-outline-primary float-end mt-2">Add Products</a>
    </h1>

    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-12">
                <form method="GET" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...." name="search">
                    </div>
                    <button type="submit" class="btn btn-outline-primary mt-2 col-1">Search</button>
                    <button type="button" class="btn btn-outline-danger mt-2 mx-3 col-1" onclick="window.location.href='products.php'">Reset</button>
                </form>
            </div>
        </div>

        <div class="table-responsive text-center bg-secondary-subtle">
            <table class="table table-bordered table-hover table-secondary rounded-4">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Sell Price</th>
                        <th>Discount Price</th>
                        <th>Discount Enabled</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                </tr>
                <tr colspan="5">
                    <?php
                    if ($num1 = mysqli_num_rows($run1) > 0){
                    } else {
                        echo "<td colspan='5'><p class='text-center text-danger'>No Products Found!</p></td>";
                    }
                    ?>
                </tr>
                <?php
                $i = 1;
                if($num1 = mysqli_num_rows($run1) > 0) {
                    while ($result = mysqli_fetch_assoc($run1)) {
                        echo "
                        <tr>
                        <td>" . $result['pro_name'] . "</td>
                        <td><img src='" . $result['pro_image'] . "' height='75px' width='75px'></td>
                        <td>" . $result['pro_sellprice'] . "</td>
                        <td>" . $result['pro_discprice'] . "</td>
                        <td>" . $result['pro_disco'] . "</td>


                        <td><a href='productupdate.php?id=" . $result['pro_id'] . "' class='btn btn-outline-warning btn-sm'>Update</a></td>
                        <td><a href='prodelete.php?id=" . $result['pro_id'] . "' class='btn btn-outline-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this category?\");'>DELETE</a></td>
                        </tr>";
                    }
                }
                ?>
            </table>
            <div class="pagination justify-content-center">
                <ul class="pagination">
                    <?php
                    if ($current_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($current_page < $total_pages && $total_records > $records_per_page) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                    }
                    ?>
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