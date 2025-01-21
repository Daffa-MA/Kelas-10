.<?php
session_start();
include 'db/database.php';

// Assuming cart items are stored in session
$cart_items = $_SESSION['cart'] ?? []; // Updated to use 'cart'
$total_price = 0;

// Calculate total price
foreach ($cart_items as $product_id => $quantity) {
    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
    $total_price += $item['price'] * $quantity; // Update to use quantity
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Your Cart - TROPIZZ Parfume</title>
</head>
<body>
<div class="container mt-5">
    <h2>Your Cart</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_items as $product_id => $quantity): ?>
                <tr>
                    <?php
                    // Fetch product details from the database
                    $sql = "SELECT * FROM products WHERE id = $product_id";
                    $result = $conn->query($sql);
                    $item = $result->fetch_assoc();
                    ?>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($quantity); ?></td>
                    <td><a href="remove_from_cart.php?id=<?php echo $product_id; ?>" class="btn btn-danger">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h5>Total Price: IDR <?php echo number_format($total_price, 0, ',', '.'); ?></h5>
    <a href="checkout_form.php" class="btn btn-success">Checkout</a>
    <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
</div>
</body>
</html>
