<?php
// Start the session
session_start();

// Include database connection
require_once 'db/database.php';

// Set header to return JSON response
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Please login to add items to your wishlist',
        'redirect' => 'login.php'
    ]);
    exit;
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Check if product_id was sent
if (!isset($_POST['product_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Product ID is required'
    ]);
    exit;
}

// Sanitize the product_id
$product_id = intval($_POST['product_id']);

// Check if product exists
$check_product = $conn->prepare("SELECT id FROM products WHERE id = ?");
$check_product->bind_param("i", $product_id);
$check_product->execute();
$product_result = $check_product->get_result();

if ($product_result->num_rows === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Product not found'
    ]);
    exit;
}

try {
    // Start transaction
    $conn->begin_transaction();

    // Check if item is already in wishlist
    $check_wishlist = $conn->prepare("SELECT id FROM wishlists WHERE user_id = ? AND product_id = ?");
    $check_wishlist->bind_param("ii", $user_id, $product_id);
    $check_wishlist->execute();
    $wishlist_result = $check_wishlist->get_result();

    if ($wishlist_result->num_rows > 0) {
        // Item exists in wishlist - remove it
        $delete_query = $conn->prepare("DELETE FROM wishlists WHERE user_id = ? AND product_id = ?");
        $delete_query->bind_param("ii", $user_id, $product_id);
        $delete_query->execute();

        $message = 'Product removed from wishlist';
        $is_added = false;
    } else {
        // Item doesn't exist in wishlist - add it
        $insert_query = $conn->prepare("INSERT INTO wishlists (user_id, product_id, created_at) VALUES (?, ?, NOW())");
        $insert_query->bind_param("ii", $user_id, $product_id);
        $insert_query->execute();

        $message = 'Product added to wishlist';
        $is_added = true;
    }

    // Commit transaction
    $conn->commit();

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => $message,
        'isInWishlist' => $is_added
    ]);

} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while updating the wishlist'
    ]);
}

// Close prepared statements
$check_product->close();
$check_wishlist->close();
if (isset($delete_query)) $delete_query->close();
if (isset($insert_query)) $insert_query->close();

// Close database connection
$conn->close();
?>