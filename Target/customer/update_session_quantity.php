<?php
session_start();

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $productId = $_POST['id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
    }
}
?>
