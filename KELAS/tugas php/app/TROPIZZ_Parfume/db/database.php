<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "tropizz_parfume"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Database created successfully
    $conn->select_db($dbname);
    
    // Create users table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error creating users table: " . $conn->error;
    }

    // Create products table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        description TEXT NOT NULL,
        image_path VARCHAR(255) NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error creating products table: " . $conn->error;
    }

    // Create reviews table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS reviews (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        product_id INT(11) NOT NULL,
        review TEXT NOT NULL,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error creating reviews table: " . $conn->error;
    }

    // Create cart table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS cart (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_id INT(11) NOT NULL,
        product_id INT(11) NOT NULL,
        quantity INT(11) NOT NULL,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error creating cart table: " . $conn->error;
    }
} else {
    echo "Error creating database: " . $conn->error;
}

// $conn->close(); // Commenting out to keep the connection open
?>
