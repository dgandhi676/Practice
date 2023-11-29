<?php
session_start();
include '../db_connect.php';
$records_per_page = 6;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $records_per_page;

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
            <a class="navbar-brand" href="cushome.php">
                <img src="../img/logo.png" class="mx-2" alt="Target Logo" width="55px" height="65px">
            </a>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-outline-primary mx-2" onclick="window.location.href='productcart.php'">
                    Cart <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                </button>
            </div>
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
                                $isActive = ($category['cat_active'] == 1) ? ' active' : '';
                                echo '<li class="nav-item"><a class="nav-link' . $isActive . '" href="cusproductpage.php?category=' . $category['cat_id'] . '">' . $category['cat_name'] . '</a></li>';
                            }
                        }
                        ?>

                    </ul>
                </div>
            </nav>
            <br>
            <main class="col-md-6 ms-sm-auto col-lg-10 px-md-4">
                <div class="row">
                    
                </div>
                <br>
                <div class="pagination justify-content-center">
                    <?php
                    if ($num1 > 0) {
                        echo '<ul class="pagination">';
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
                        echo '</ul>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>