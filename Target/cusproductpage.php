<?php
session_start();
include 'db_connect.php';
$id = $_GET['id'];
$sql = "SELECT * FROM product_master WHERE pro_id='" . $id . "'";
$result = mysqli_query($conn, $sql);
$fet = $result->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fet['pro_name']; ?></title>
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
            <h2 class="navbar text-center"><?php echo $fet['pro_name']; ?></h2>
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
            <br>
            <main class="col-md-6 ms-sm-auto col-lg-10 px-md-4">
                <div class="row">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?php echo $fet['pro_image']; ?>" alt="Product Image" class="img-fluid h-100 w-75">
                            </div>
                            <div class="col-md-6">
                                <h1><?php echo $fet['pro_name']; ?></h1>
                                <p><?php echo $fet['pro_des']; ?></p>
                                <p>Price: <?php
                                            if ($fet['pro_disco'] == "Yes") {
                                                echo 'Rs.' . $fet['pro_discprice'];
                                            } else {
                                                echo 'Rs.' . $fet['pro_sellprice'];
                                            }
                                            ?></p>
                                <a href="productcart.php?id=<?php echo $fet['pro_id']; ?>&quantity=1" class="btn btn-outline-primary">Add to Cart</a>
                            </div>
                        </div>
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