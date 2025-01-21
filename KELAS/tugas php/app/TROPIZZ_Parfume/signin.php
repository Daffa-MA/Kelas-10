<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - TROPIZZ Parfume</title>
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
        <h2>Sign In to Your Account</h2>
        <form action="signin.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-secondary">Sign In</button>
        </form>

        <?php
        session_start(); // Start the session

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'db/database.php';

            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id']; // Set session variable
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Invalid password.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>No user found with that email.</div>";
            }

            $conn->close();
        }
        ?>
    </main>
    <script src="js/scripts.js"></script>
</body>
</html>
