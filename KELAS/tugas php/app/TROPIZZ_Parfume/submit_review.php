<?php
include 'db/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST['product_id']);
    $review = $conn->real_escape_string(trim($_POST['review']));
    $rating = intval($_POST['rating']); // Get the rating

    // Insert review into the database
    $sql = "INSERT INTO reviews (product_id, review, rating, date) VALUES ($product_id, '$review', $rating, NOW())";
    
    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully.";
    } else {
        echo "Error submitting review: " . $conn->error;
    }
}

$conn->close();
header("Location: product_details.php?id=" . $product_id); // Redirect back to product details
exit;
?>
