<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - TROPIZZ Parfume</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">TROPIZZ Parfume</a>
        </nav>
    </header>
    <main class="container mt-4">
        <h2>User Profile</h2>
        <?php
        session_start();
        include 'db/database.php';

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM users WHERE id='$user_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['username'] ?? '';
                $email = $row['email'] ?? '';
                $role = $row['role'] ?? '';

                echo "<div class='card mb-4'>";
                echo "<div class='card-body'>";
                echo "<form action='profile.php' method='POST'>";
                echo "<a href='logout.php' class='btn btn-danger'>Logout</a>";
                echo "<div class='form-group'>";
                echo "<label for='username'>Username</label>";
                echo "<input type='text' class='form-control' id='username' name='username' value='" . htmlspecialchars($username) . "' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='email'>Email</label>";
                echo "<input type='email' class='form-control' id='email' name='email' value='" . htmlspecialchars($email) . "' required>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-secondary'>Update Profile</button>";
                echo "</form>";
                echo "</div></div>";

                // Handle profile update
                if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['new_password'])) {
                    $username = $_POST['username'] ?? '';
                    $email = $_POST['email'] ?? '';

                    $update_sql = "UPDATE users SET username='$username', email='$email' WHERE id='$user_id'";
                    if ($conn->query($update_sql) === TRUE) {
                        echo "<div class='alert alert-success'>Profile updated successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error updating profile: " . $conn->error . "</div>";
                    }
                }

                // Password change form
                echo "<h3>Change Password</h3>";
                echo "<form action='profile.php' method='POST'>";
                echo "<div class='form-group'>";
                echo "<label for='new_password'>New Password</label>";
                echo "<input type='password' class='form-control' id='new_password' name='new_password' required>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-secondary'>Change Password</button>";
                echo "</form>";

                // Handle password change
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_password'])) {
                    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    $password_sql = "UPDATE users SET password='$new_password' WHERE id='$user_id'";
                    if ($conn->query($password_sql) === TRUE) {
                        echo "<div class='alert alert-success'>Password changed successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error changing password: " . $conn->error . "</div>";
                    }
                }

                // Admin functionality
                if ($role === 'admin') {
                    echo "<h3>Admin Dashboard</h3>";
                    echo "<p>Welcome, Admin! You have access to additional features.</p>";
                    echo "<a href='admin_panel.php' class='btn btn-info'>Go to Admin Panel</a>";
                }
            } else {
                echo "<div class='alert alert-danger'>User not found.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Please log in to view your profile.</div>";
        }

        $conn->close();
        ?>
    </main>
    <script src="js/scripts.js"></script>
</body>
</html>
