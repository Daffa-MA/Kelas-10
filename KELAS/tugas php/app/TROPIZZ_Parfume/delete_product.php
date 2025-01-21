<?php
include 'db/database.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id='$product_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_panel.php?message=Product deleted successfully!");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$conn->close();
?>
