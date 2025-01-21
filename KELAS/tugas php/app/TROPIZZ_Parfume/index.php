<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TROPIZZ Parfume</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .product-card {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.2s;
            height: 420px; /* Set a fixed height for uniformity */
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-img {
            height: 200px;
            object-fit: cover;
        }
        .row {
            justify-content: center; /* Center align the product cards */
        }
        .notification {
            position: relative;
            display: inline-block;
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
                        <?php 
                        session_start();
                        if (!isset($_SESSION['cart'])) {
                            $_SESSION['cart'] = []; // Initialize the cart as an empty array
                        }
                        $cart_count = count($_SESSION['cart']);
                        ?>
                        <a class="nav-link" href="cart.php">Cart 
                        <?php if ($cart_count > 0): ?>
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
    
    <!-- Banner Section -->
    <img src="images/banner.jpeg" class="img-fluid" alt="TROPIZZ Parfume Banner">
    <div class="bg-secondary text-white text-center p-4">
        <h1>Welcome to TROPIZZ Parfume</h1>
        <p>Your one-stop shop for elegant fragrances.</p>
    </div>

    <!-- Products Section -->
    <div class="container mt-4">
        <h2>Our Products</h2>
        <div class="row">
            <?php
            include 'db/database.php';
            $sql = "SELECT * FROM products"; // Retrieve all products
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='product-card'>";
                    echo "<img src='" . htmlspecialchars($row['image_path']) . "' class='card-img-top product-img' alt='" . htmlspecialchars($row['name']) . "'>"; // Display product image
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . htmlspecialchars($row['name']) . "</h5>";
                    echo "<p class='card-text'>Price: IDR " . htmlspecialchars($row['price']) . "</p>"; // Updated currency to IDR
                    echo "<p class='card-text'>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<a href='product_details.php?id=" . $row['id'] . "' class='btn btn-secondary'>View Details</a>";
                    echo "</div></div></div>";
                }
            } else {
                echo "<p>No products available.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
    
    <script src="js/scripts.js"></script>
</body>
</html>
