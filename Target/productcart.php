<?php
session_start();
include 'db_connect.php';
$id = $_GET['id'];
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$cart = $_SESSION['cart'];
$cart[$id] = 1;
header('Location: productcart.php');
$sql = "SELECT * FROM product_master WHERE pro_id='" . $id . "'";
$run1 = mysqli_query($conn, $sql);
if ($num1 = mysqli_num_rows($run1) > 0) {
    $result = mysqli_fetch_assoc($run1);
    echo "<h1>" . $result['pro_name'] . "</h1>";
    echo "<p>" . $result['pro_des'] . "</p>";
    echo "<p>Price: Rs." . $result['pro_sellprice'] . "</p>";
} else {
    echo "<p>No product found!</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="cushome.php">
                <img src="img/logo.png" class="mx-2" alt="Target logo" width="55px" height="65px">
            </a>
            <h2 class="navbar text-center">Cart</h2>
            <button type="button" class="btn btn-outline-danger mx-2 my-2 my-lg-0 d-flex align-items-center" onclick="window.location.href='cusloginsignup.php'">
                Login/Signup
            </button>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <?php
                        $categorySql = "SELECT * FROM category_master";
                        $categoryResult = mysqli_query($conn, $categorySql);

                        if (mysqli_num_rows($categoryResult) > 0) {
                            while ($category = mysqli_fetch_assoc($categoryResult)) {
                                $isActive = ($category['cat_active'] == 1) ? 'active' : '';
                                echo '<li class="nav-item">
                    <a class="nav-link ' . $isActive . '" href="#">
                        ' . $category['cat_name'] . '
                    </a>
                  </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

            </nav>
            <main class="col-md-6 ms-sm-auto col-lg-10 px-md-4">
                <div class="row">
                    <div class="table-responsive text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tr colspan="5">
                                <?php
                                if ($num1 = mysqli_num_rows($run1) > 0) {
                                } else {
                                    echo "<td colspan='5'><p class='text-center text-danger'>No Products Found!</p></td>";
                                }
                                ?>
                            </tr>
                            <?php
                            $i = 1;
                            if ($num1 = mysqli_num_rows($run1) > 0) {
                                while ($result = mysqli_fetch_assoc($run1)) {
                                    echo "
                        <tr>
                        <td><img src='" . $result['pro_image'] . "' height='75px' width='75px'></td>
                        <td>" . $result['pro_name'] . "</td>
                        <td>" . $result['pro_sellprice'] . "</td>
                        <td>" . $result['pro_discprice'] . "</td>

                        <td><a href='prodelete.php?id=" . $result['pro_id'] . "' class='btn btn-outline-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this category?\");'>DELETE</a></td>
                        </tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </main>
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