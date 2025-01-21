<?php
session_start();
include 'db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $payment = trim($_POST['payment_method']); // Updated to use 'payment_method'

    if (empty($name) || empty($address) || empty($payment)) {
        echo "All fields are required.";
        exit;
    }

    // Insert order into database
    $user_id = $_SESSION['user_id'] ?? null; // Assuming user is logged in
    $total_price = 0;

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT price FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $total_price += $product['price'] * $quantity;
        }
    }

    // Debugging statements
    error_log("Cart contents: " . print_r($_SESSION['cart'], true));
    error_log("Total price calculated: IDR " . $total_price);

    $order_sql = "INSERT INTO orders (user_id, total_price, shipping_address, payment_method) VALUES ('$user_id', '$total_price', '$address', '$payment')";
    if ($conn->query($order_sql) === TRUE) {
        // Get the last inserted order ID as invoice number
        $invoice_number = $conn->insert_id;
        $_SESSION['invoice_number'] = $invoice_number; // Store in session
        $_SESSION['total_price'] = $total_price; // Store total price in session

        // Clear the cart
        unset($_SESSION['cart']);
        header("Location: confirmation.php");
        exit;

    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
