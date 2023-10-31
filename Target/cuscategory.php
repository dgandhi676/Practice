<?php
include 'db_connect.php';
$records_per_page = 6;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $records_per_page;
if (isset($_GET['category']) && is_numeric($_GET['category'])) {
    $categoryId = intval($_GET['category']);
    $sql = "SELECT * FROM product_master WHERE pro_category_id = $categoryId ORDER BY pro_id ASC LIMIT $records_per_page";
} else {
    // Default query to fetch all products
    $sql = "SELECT * FROM product_master ORDER BY pro_id ASC LIMIT $records_per_page";
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
    <title>Category</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="cushome.php">
                <img src="img/logo.png" alt="Target logo" width="55px" height="65px">
            </a>
            <h2 class="navbar text-center">Category</h2>
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
                                echo '<li class="nav-item"><a class="nav-link ' . $isActive . '" href="#">' . $category['cat_name'] . '
                                </a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </nav>

            <main class="col-md-6 ms-sm-auto col-lg-10 px-md-4">
                <div class="row">
                    <?php
                    if ($num1 = mysqli_num_rows($run1) > 0) {
                        while ($result = mysqli_fetch_assoc($run1)) {
                    ?>
                            <div class="col-md-4 mt-3">
                                <div class="card d-flex align-items-center">
                                    <img src="<?php echo $result['pro_image']; ?>" style="height: 150px; width: 150px;" class="card-img-top my-2" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><?php echo $result['pro_name']; ?></h5>
                                        <p class="card-text text-center">
                                            <?php
                                            if ($result['pro_disco'] == "Yes") {
                                                echo 'Rs.' . $result['pro_discprice'];
                                            } else {
                                                echo 'Rs.' . $result['pro_sellprice'];
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<div class='col-12'><p class='text-center text-danger'>No Products Found!</p></div>";
                    }
                    ?>
                </div>
                <br>
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