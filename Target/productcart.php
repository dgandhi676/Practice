<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][$id] = 1;

    header('Location: productcart.php');
} else {
    // echo "<p>No product found!</p>";
}
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $productIds = implode(',', array_keys($_SESSION['cart']));
    $sql = "SELECT * FROM product_master WHERE pro_id IN ($productIds)";
    $run1 = mysqli_query($conn, $sql);
} else {
    $run1 = false;
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
                            <tbody>
                                <?php
                                if ($run1 && mysqli_num_rows($run1) > 0) {
                                    while ($result = mysqli_fetch_assoc($run1)) {
                                        $price = ($result['pro_disco'] == "Yes") ? $result['pro_discprice'] : $result['pro_sellprice'];
                                        echo "
                                <tr>
                                    <td><img src='" . $result['pro_image'] . "' height='75px' width='75px'></td>
                                    <td>" . $result['pro_name'] . "</td>
                                    <td>Rs." . $price . "</td>
                                    <td><input type='number' class='quantity-input' data-id='" . $result['pro_id'] . "' value='1' min='1'></td>
                                    <td><a href='#' class='btn btn-outline-danger btn-sm delete-btn' data-id='" . $result['pro_id'] . "'>DELETE</a></td>
                                </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'><p class='text-center text-danger'>No Products Found!</p></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-outline-primary" id="checkout-btn">Checkout</button>
                            </div>
                            <div class="col-md-6 text-end">
                                <h4>Total: <span id="total-price">Rs. 0</span></h4>
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
    <script>
    // Function to update total price based on quantity changes
    function updateTotalPrice() {
        let totalPrice = 0;
        $('.quantity-input').each(function() {
            const productId = $(this).data('id');
            const quantity = parseInt($(this).val());
            const price = parseFloat($(this).closest('tr').find('td:nth-child(3)').text().replace('Rs.', '').trim());
            totalPrice += quantity * price;
        });
        $('#total-price').text('Rs. ' + totalPrice.toFixed(2));
    }

    // Event listener for quantity changes
    $('.quantity-input').on('input', function() {
        updateTotalPrice();
    });

    // Event listener for delete buttons
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        const productId = $(this).data('id');
        if (confirm("Are you sure you want to delete this product?")) {
            // Implement your code to remove the product from the session or database
            $.get('delete_product.php', { id: productId }, function(response) { });
            $(this).closest('tr').remove();
        }
    });

    // Event listener for checkout button
    $('#checkout-btn').on('click', function() {
        window.location.href = 'checkout.php';
    });

    // Initial calculation of total price
    updateTotalPrice();
</script>
</body>

</html>