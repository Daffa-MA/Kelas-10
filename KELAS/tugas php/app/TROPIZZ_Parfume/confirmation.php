<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Confirmation - TROPIZZ Parfume</title>
    <style>
        body {
            background-color: #f0f8ff;
        }
        .success-container {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            background-color: #e0f7fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .success-icon {
            font-size: 50px;
            color: #4caf50;
        }
        .invoice-number {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container success-container">
    <div class="success-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <h2>SUCCESS</h2>
    <p>You have successfully placed your order!</p>
    <p class="invoice-number">Invoice Number: <?php echo $_SESSION['invoice_number']; ?></p>
    <p>Total Price: IDR <?php echo number_format($_SESSION['total_price'], 0, ',', '.'); ?></p>
    <p>Thank you for shopping with us!</p>
    <p>You will be redirected shortly...</p>
</div>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    setTimeout(function() {
        window.location.href = 'index.php'; // Redirect to homepage after 8 seconds
    }, 8000);
</script>
</body>
</html>
