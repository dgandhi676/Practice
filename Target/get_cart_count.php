<?php
session_start();

// Check if the cart session variable exists, and echo the count
echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
