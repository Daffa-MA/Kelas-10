<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Check if the cart session exists
    if (isset($_SESSION['cart'][$product_id])) {
        if ($_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--; // Decrease quantity
        } else {
            unset($_SESSION['cart'][$product_id]); // Remove the product from the cart
        }
    }

    echo "Product quantity updated successfully.";
}

// Redirect back to the cart page
header("Location: cart.php");
exit;
?>
