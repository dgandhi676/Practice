<?php
session_start();
include '../db_connect.php';
if (!isset($_SESSION['randomString'])) {
    header("Location: cushome.php");
    exit();
}


if (isset($_SESSION["customerEmail"])) {
    $user_email = $_SESSION["customerEmail"];
    $user_query = "SELECT cus_address, cus_name FROM customer_master WHERE cus_email = '$user_email'";
    $user_result = mysqli_query($conn, $user_query);
    $user_data = mysqli_fetch_assoc($user_result);
    $user_address = $user_data['cus_address'];
    $user_name = $user_data['cus_name'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['placeOrder'])) {
    $totalPrice = 0;
    $orderDetails = [];
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $productQuery = "SELECT pro_name, pro_disco, pro_discprice, pro_sellprice FROM product_master WHERE pro_id = $productId";
        $productResult = mysqli_query($conn, $productQuery);
        $productData = mysqli_fetch_assoc($productResult);

        $productName = $productData['pro_name'];
        $price = ($productData['pro_disco'] == "Yes") ? $productData['pro_discprice'] : $productData['pro_sellprice'];

        $totalPrice += $quantity * $price;

        // Add order details to the array
        $orderDetails[] = [
            'product_name' => $productName,
            'quantity' => $quantity,
            'price' => $price
        ];
    }
    $_SESSION['orderDetails'] = [
        'totalPrice' => $totalPrice,
        'customerName' => $user_name,
        'orderDetails' => $orderDetails
    ];
    $updatedAddress = mysqli_real_escape_string($conn, $_POST['orderAddress']);
    $updateAddressQuery = "UPDATE customer_master SET cus_address = '$updatedAddress' WHERE cus_email = '$user_email'";
    mysqli_query($conn, $updateAddressQuery);
    
    // Insert order into order_product_master table
    $insertOrderQuery = "INSERT INTO order_product_master (customer_name, amount_order, date_order) VALUES ('$user_name', $totalPrice, NOW())";
    mysqli_query($conn, $insertOrderQuery);
    $orderId = mysqli_insert_id($conn);

    // Insert order details into order_details table
    foreach ($orderDetails as $detail) {
        $productName = $detail['product_name'];
        $quantity = $detail['quantity'];
        $price = $detail['price'];

        $insertOrderDetailsQuery = "INSERT INTO order_details (order_id, product_name, quantity, price) VALUES ($orderId, '$productName', $quantity, $price)";
        mysqli_query($conn, $insertOrderDetailsQuery);
    }

    // Redirect to order success page
    header("Location: order_success.php");
    exit();
}
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
                <img src="../img/logo.png" class="mx-2" alt="Target logo" width="55px" height="65px">
            </a>
            <h2 class="navbar text-center mb-0 mx-auto">Checkout</h2>
        </div>
    </nav>

    <div class="container mt-4">
        <form method="post" action="" id="orderForm">
            <h3>Order Summary</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
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
                                <td>" . $quantity . "</td>
                                <td>Rs. " . $price . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'><p class='text-center text-danger'>No Products Found!</p></td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td>
                            <div class="mt-3">
                                <h4>Total Price: Rs. <?php echo ($totalPrice); ?></h4>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-floating my-3">
                                <textarea class="form-control form-control-md" name="orderAddress" id="orderAddress" placeholder="Enter Address"><?php echo isset($user_address) ? $user_address : ''; ?></textarea>
                                <label for="orderAddress" class="form-label">Address:</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-outline-success" name="placeOrder">Place Order</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Pooper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>