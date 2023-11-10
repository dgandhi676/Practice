<?php
session_start();
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid d-flex align-items-center">
            <a class="navbar-brand" href="cushome.php">
                <img src="img/logo.png" class="mx-2" alt="Target logo" width="55px" height="65px">
            </a>
            <h2 class="navbar text-center mb-0 mx-auto">Checkout</h2>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Order Summary</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $totalPrice = 0;

                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $productIds = implode(',', array_keys($_SESSION['cart']));
                    $sql = "SELECT * FROM product_master WHERE pro_id IN ($productIds)";
                    $run = mysqli_query($conn, $sql);

                    while ($product = mysqli_fetch_assoc($run)) {
                        $productId = $product['pro_id'];
                        $quantity = $_SESSION['cart'][$productId];
                        $price = ($product['pro_disco'] == "Yes") ? $product['pro_discprice'] : $product['pro_sellprice'];

                        $totalPrice += $quantity * $price;

                        echo "
                            <tr>
                                <td><img src='" . $product['pro_image'] . "' height='75px' width='75px'></td>
                                <td>" . $product['pro_name'] . "</td>
                                <td>Rs." . $price . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'><p class='text-center text-danger'>No Products Found!</p></td></tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td>
                        <div class="mt-3">
                            <h4>Total Price: Rs. <?php echo ($totalPrice); ?></h4>
                        </div>
                    </td>
                </tr>
            </tfoot>
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