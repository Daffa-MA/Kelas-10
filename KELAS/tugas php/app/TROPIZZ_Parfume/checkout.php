<?php
session_start();
include 'db/database.php';

// Assuming cart items are stored in session
$cart_items = $_SESSION['cart_items'] ?? [];
$total_price = 0;

// Calculate total price
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Checkout Confirmation - TROPIZZ Parfume</title>
    <style>
        body {
            background-color: #f0f8ff;
        }
        .confirmation-container {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            background-color: #e0f7fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="container confirmation-container">
    <h2>Checkout Confirmation</h2>
    <p>Thank you for your order!</p>
    <h4>Your Order Summary:</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>IDR <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h5>Total Amount: IDR <?php echo number_format($total_price, 0, ',', '.'); ?></h5>
    <p>You will be redirected shortly...</p>
</div>
<script>
    setTimeout(function() {
        window.location.href = 'index.php'; // Redirect to homepage after 8 seconds
    }, 8000);
</script>
</body>
</html>
