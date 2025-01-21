<?php
include 'db/database.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - TROPIZZ Parfume</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product-container {
            display: flex;
            margin-top: 20px;
        }
        .product-image {
            flex: 1;
            margin-right: 20px;
        }
        .product-details {
            flex: 2;
        }
        .product-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
        }
        .review {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }
        .badge {
            position: absolute;
            top: 9px;
            right: 210px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 6px;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">TROPIZZ Parfume</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart 
                        <?php 
                        session_start();
                        $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                        if ($cart_count > 0): ?>
                            <span class="badge"><?php echo $cart_count; ?></span>
                        <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signin.php">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container product-container">
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['image_path']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="product-details">
            <div class="product-card">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p>Price: IDR <?php echo htmlspecialchars($product['price']); ?></p>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <form action="add_to_cart.php" method="POST" class="mt-3">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>
                <a href="index.php" class="btn btn-secondary mt-2">Back to Products</a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h3>Reviews</h3>
        <form action="submit_review.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="">Select Rating</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <div class="form-group">
                <label for="review">Leave a Review:</label>
                <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-secondary">Submit Review</button>
        </form>

        <h3>Submitted Reviews</h3>
        <div class="reviews">
            <?php
            $review_sql = "SELECT review, rating, date FROM reviews WHERE product_id = $product_id";
            $review_result = $conn->query($review_sql);

            if ($review_result->num_rows > 0) {
                while ($review = $review_result->fetch_assoc()) {
                    echo "<div class='review'>";
                    echo "<p>" . nl2br(htmlspecialchars($review['review'])) . "</p>";
                    echo "<p>Rating: " . str_repeat("⭐", htmlspecialchars($review['rating'])) . "</p>";
                    echo "<p>Date: " . htmlspecialchars($review['date']) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews yet.</p>";
            }
            ?>
        </div>

        <h3>Related Products</h3>
        <div class="row">
            <?php
            $related_sql = "SELECT * FROM products WHERE id != $product_id LIMIT 3";
            $related_result = $conn->query($related_sql);

            if ($related_result->num_rows > 0) {
                while ($related_product = $related_result->fetch_assoc()) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='product-card'>";
                    echo "<img src='" . htmlspecialchars($related_product['image_path']) . "' class='card-img-top' alt='" . htmlspecialchars($related_product['name']) . "'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($related_product['name']) . "</h5>";
                    echo "<p class='card-text'>Price: IDR " . htmlspecialchars($related_product['price']) . "</p>";
                    echo "<a href='product_details.php?id=" . $related_product['id'] . "' class='btn btn-secondary'>View Details</a>";
                    echo "</div></div></div>";
                }
            } else {
                echo "<p>No related products available.</p>";
            }
            ?>
        </div>
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>
