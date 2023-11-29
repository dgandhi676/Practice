<?php
session_start();
// echo $_SESSION['customerEmail'];

include '../db_connect.php';
if (isset($_SESSION['customerEmail']) && !empty($_SESSION['customerEmail'])) {
    $isLoggedIn = true;
} else {
    $isLoggedIn = false;
}

isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    header('Location: productcart.php');
}
if (isset($_GET['action']) && $_GET['action'] == "remove" && isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!empty($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$id]);
    }

    header('Location: productcart.php');
}

if (isset($_GET['action']) && $_GET['action'] == "empty") {
    unset($_SESSION['cart']);
    header('Location: productcart.php');
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
                <img src="../img/logo.png" class="mx-2" alt="Target logo" width="55px" height="65px">
            </a>
            <div class="text-center">
                <h2 class="navbar">Cart</h2>
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
                                        $productId = $result['pro_id'];
                                        $quantity = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] : 1;
                                        $price = ($result['pro_disco'] == "Yes") ? $result['pro_discprice'] : $result['pro_sellprice'];
                                        echo "
                                        <tr>
                                        <td><img src='" . $result['pro_image'] . "' height='75px' width='75px'></td>
                                        <td>" . $result['pro_name'] . "</td>
                                        <td>Rs." . $price . "</td>
                                        <td><input type='number' class='quantity-input' data-id='" . $productId . "' value='" . $quantity . "' min='1'></td>
                                        <td><button class='btn btn-outline-danger btn-sm delete-btn' data-id='" . $productId . "'>DELETE</button></td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'><p class='text-center text-danger'>No Products Found!</p></td></tr>";
                                }
                                ?>

                            </tbody>x
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
        $('#checkout-btn').on('click', function() {
            const vl = "<?php echo $isLoggedIn; ?>";

            if (vl) {
                window.location.href = 'checkout.php';
            } else {
                window.location.href = 'cusloginsignup.php';

            }
        });


        $('.quantity-input').on('input', function() {
            const productId = $(this).data('id');
            const quantity = $(this).val();

            $.post('update_quantity.php', {
                id: productId,
                quantity: quantity
            }, function(response) {});

            updateSessionQuantity(productId, quantity);

            updateTotalPrice();
        });

        function updateSessionQuantity(productId, quantity) {

            $.post('update_session_quantity.php', {
                id: productId,
                quantity: quantity
            }, function(response) {});
        }

        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('id');
            if (confirm("Are you sure you want to delete this product?")) {
                $.get('productcart.php?action=remove&id=' + productId, function(response) {

                });
                $(this).closest('tr').remove();
                updateTotalPrice();
            }
        });
        console.log("session", <?php echo json_encode($_SESSION); ?>);
        updateTotalPrice();
    </script>
</body>

</html>