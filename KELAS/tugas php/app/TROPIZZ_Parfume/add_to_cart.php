<?php
session_start();
include 'db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST['product_id']);
    $quantity = 1; // Default quantity

    // Check if the cart session exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$product_id] += $quantity; // Increase quantity
    } else {
        $_SESSION['cart'][$product_id] = $quantity; // Add new product
    }

    // Set notification session variable
    $_SESSION['notification'] = "Product added to cart successfully.";
}

// Redirect back to the product details page
header("Location: product_details.php?id=" . $product_id);
exit;
?>
