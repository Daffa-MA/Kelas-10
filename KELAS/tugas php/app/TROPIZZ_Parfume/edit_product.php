<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - TROPIZZ Parfume</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">TROPIZZ Parfume</a>
        </nav>
    </header>
    <main class="container">
        <h2>Edit Product</h2>
        <?php
        include 'db/database.php';

        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id='$product_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row['name'] ?? '';
                $price = $row['price'] ?? '';
                $description = $row['description'] ?? '';

                echo "<form action='edit_product.php?id=$product_id' method='POST'>";
                echo "<div class='form-group'>";
                echo "<label for='name'>Product Name</label>";
                echo "<input type='text' class='form-control' id='name' name='name' value='" . htmlspecialchars($name) . "' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='price'>Price</label>";
                echo "<input type='number' class='form-control' id='price' name='price' value='" . htmlspecialchars($price) . "' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='description'>Description</label>";
                echo "<textarea class='form-control' id='description' name='description' required>" . htmlspecialchars($description) . "</textarea>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-success'>Update Product</button>";
                echo "</form>";
            } else {
                echo "<div class='alert alert-danger'>Product not found.</div>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            $update_sql = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id='$product_id'";

            if ($conn->query($update_sql) === TRUE) {
                echo "<div class='alert alert-success'>Product updated successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        }

        $conn->close();
        ?>
    </main>
    <script src="js/scripts.js"></script>
</body>
</html>
