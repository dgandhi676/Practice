<?php
include 'db_connect.php';
$records_per_page = 3;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = intval($_GET['page']);
} else {
    $current_page = 1;
}
$offset = ($current_page - 1) * $records_per_page;
// Search Query
if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM category_master WHERE 
            cat_name LIKE '%$searchTerm%' OR 
            cat_image LIKE '%$searchTerm%' OR 
            cat_active LIKE '%$searchTerm%'
            ORDER BY cat_id ASC LIMIT $offset, $records_per_page";
} else {

    $sql = "SELECT * FROM category_master ORDER BY cat_id ASC LIMIT $offset, $records_per_page";
}
$run1 = mysqli_query($conn, $sql);
$total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM category_master"));
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
                <img src="img/logo.png" alt="Target Logo" width="55px" height="65px">
            </a>
            <h2 class="navbar text-center" href="cuscategory.php">Category</h2>
            <button type="button" class="btn btn-outline-danger mx-2 my-2 my-lg-0 d-flex align-content-center" onclick="window.location.href='cusloginsignup.php'">login / Signup</button>
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
                    <?php
                    while ($row = mysqli_fetch_assoc($run1)) {
                        echo '<div class="col-md-4 mt-3">
                    <div class="card d-flex align-items-center">
                        <img src="' . $row['cat_image'] . '" class="card-img-top h-100 w-50" alt="' . $row['cat_name'] . '" >
                        <div class="card-body">
                            <h5 class="card-title text-center">' . $row['cat_name'] . '</h5>
                            <a href="cusproductpage.php?category=' . $row['cat_id'] . '" class="btn btn-primary">View Products</a>
                        </div>
                    </div>
                </div>';
                    }
                    ?>
                </div>

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
    <!-- Bootstrap Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>