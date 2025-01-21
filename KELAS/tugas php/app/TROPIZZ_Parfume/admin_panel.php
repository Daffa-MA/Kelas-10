<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - TROPIZZ Parfume</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">TROPIZZ Parfume</a>
        </nav>
    </header>
    <main class="container">
        <h2>Admin Panel</h2>
        <p>Manage your products here.</p>
        <a href="add_product.php" class="btn btn-success">Add Product</a>
        <h3>Existing Products</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db/database.php';
                $sql = "SELECT * FROM products"; // Assuming you have a products table
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                        echo "<td>
                                <a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-secondary'>Edit</a>
                                <a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <script src="js/scripts.js"></script>
</body>
</html>
