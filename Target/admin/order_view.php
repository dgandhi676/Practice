<?php
session_start();
include '../db_connect.php';
// echo $_SESSION['randomString'];

if (!isset($_SESSION['adminRandomString'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['id'])) {
    $customerId = $_GET['id'];

    // Fetch customer details and order history
    $customerQuery = "SELECT * FROM order_product_master WHERE sr_no = $customerId";
    $customerResult = mysqli_query($conn, $customerQuery);
    $customerData = mysqli_fetch_assoc($customerResult);

    // Fetch customer address
    $customerAddressQuery = "SELECT cus_address FROM customer_master WHERE cus_email = '" . $customerData['customer_name'] . "'";
    $customerAddressResult = mysqli_query($conn, $customerAddressQuery);
    $customerAddressData = mysqli_fetch_assoc($customerAddressResult);

    // Fetch customer order details
    $orderDetailsQuery = "SELECT * FROM order_details WHERE order_id = $customerId";
    $orderDetailsResult = mysqli_query($conn, $orderDetailsQuery);
} else {
    // Handle the case where customer ID is not provided
    echo "<h3 class='text-danger text-center'>Invalid request</h3>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order View</title>
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
                <a href="home.php" class="navbar-brand">
                    <img src="../img/logo.png" alt="Target Logo" width="45px" height="65px">
                </a>
            </div>
            <button type="button" class="btn btn-outline-danger mx-2 my-2 my-lg-0" onclick="window.location.href='logout.php'">
                <i class="bi bi-door-closed" style="font-size: 15px;"></i> Logout
            </button>
        </div>
    </nav>
    <div class="container mt-4">
        <h3>Customer Order Details</h3>
        <p><strong>Customer Name:</strong> <?php echo $customerData['customer_name']; ?></p>
        <p><strong>Address:</strong> <?php echo $customerAddressData['customer_address']; ?></p>
        <p><strong>Amount:</strong> Rs. <?php echo $customerData['amount_order']; ?></p>
    </div>

    <!-- Display ordered items in a table -->
    <div class="container mt-4">
        <h4>Ordered Items</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($orderDetail = mysqli_fetch_assoc($orderDetailsResult)) {
                    // Fetch additional product details
                    $productId = $orderDetail['product_id'];
                    $productQuery = "SELECT * FROM product_master WHERE pro_id = $productId";
                    $productResult = mysqli_query($conn, $productQuery);

                    // Check for errors in the product query
                    if (!$productResult) {
                        echo "<tr><td colspan='4'><p class='text-danger'>Error fetching product details.</p></td></tr>";
                        break; // Exit the loop
                    }

                    $productData = mysqli_fetch_assoc($productResult);

                    echo "
                <tr>
                    <td><img src='" . $productData['pro_image'] . "' height='75px' width='75px'></td>
                    <td>" . $productData['pro_name'] . "</td>
                    <td>" . $orderDetail['quantity'] . "</td>
                    <td>Rs. " . $orderDetail['price'] . "</td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Display total amount -->
    <div class="container mt-4">
        <p><strong>Total Amount:</strong> Rs. <?php echo $customerData['amount_order']; ?></p>
    </div>


</body>

</html>