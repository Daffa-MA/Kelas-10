<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "toko_parfum";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

session_start();

// Tambah produk ke keranjang
if (isset($_GET['beli'])) {
    $id_produk = $_GET['beli'];
    $_SESSION['keranjang'][$id_produk] = isset($_SESSION['keranjang'][$id_produk]) ? $_SESSION['keranjang'][$id_produk] + 1 : 1;
    header("Location: ?page=keranjang");
    exit;
}

// Hapus produk dari keranjang
if (isset($_GET['hapus'])) {
    $id_produk = $_GET['hapus'];
    unset($_SESSION['keranjang'][$id_produk]);
    header("Location: ?page=keranjang");
    exit;
}

// Tambah produk baru
if (isset($_POST['tambah_produk'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $tmp   = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "images/" . $gambar);

    mysqli_query($conn, "INSERT INTO produk (nama, harga, gambar) VALUES ('$nama', '$harga', '$gambar')");
    header("Location: ?page=admin");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Parfum Online</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color:rgb(41, 41, 41); /* Background abu-abu */
            padding: 20px;
            color: #fff;
        }
        a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #FFD700; /* Emas */
            color: black;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #e6c200; /* Warna emas lebih gelap saat hover */
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header h1 {
            color: #FFD700; /* Emas */
            font-size: 2.5em;
        }

        /* Navigation */
        nav {
            text-align: center;
            margin-bottom: 30px;
        }
        nav a {
            margin: 0 10px;
            font-size: 1.2em;
        }

        /* Product Cards */
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            background-color:rgb(32, 31, 31);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-card img {
            width: 100%;
            height: 180px; /* Ukuran gambar diperkecil */
            object-fit: cover;
            background-color: #333; /* Background gambar hitam */
        }
        .product-card h3 {
            padding: 10px;
            font-size: 1.2em;
            color: #FFD700; /* Emas */
        }
        .product-card p {
            padding: 0 10px 10px;
            color: #bbb;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: #FFD700; /* Emas */
            color: black;
            border-radius: 5px;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #e6c200; /* Warna emas lebih gelap saat hover */
        }

        /* Table Style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #FFD700; /* Emas */
            color: black;
        }
    </style>
</head>
<body>

<header>
    <h1>Toko Parfum Online</h1>
</header>

<nav>
    <a href="?page=home">Home</a>
    <a href="?page=keranjang">Keranjang</a>
    <a href="?page=admin">Admin Panel</a>
</nav>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Halaman Home
if ($page == 'home') {
    echo '<div class="product-container">';
    $query = mysqli_query($conn, "SELECT * FROM produk");
    while ($produk = mysqli_fetch_assoc($query)) {
        echo '<div class="product-card">
                <img src="images/' . $produk['gambar'] . '" alt="' . $produk['nama'] . '">
                <h3>' . $produk['nama'] . '</h3>
                <p>Rp ' . number_format($produk['harga'], 0, ',', '.') . '</p>
                <a href="?beli=' . $produk['id'] . '" class="btn">Beli</a>
              </div>';
    }
    echo '</div>';
}

// Halaman Keranjang
elseif ($page == 'keranjang') {
    echo "<h2>Keranjang Belanja</h2>";
    if (empty($_SESSION['keranjang'])) {
        echo "<p>Keranjang kosong.</p>";
    } else {
        echo "<table>
                <tr><th>No</th><th>Produk</th><th>Jumlah</th><th>Aksi</th></tr>";
        $no = 1;
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
            $produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk"));
            echo "<tr>
                    <td>$no</td>
                    <td>{$produk['nama']}</td>
                    <td>$jumlah</td>
                    <td><a href='?hapus=$id_produk' class='btn'>Hapus</a></td>
                  </tr>";
            $no++;
        }
        echo "</table>";
    }
}

// Halaman Admin
elseif ($page == 'admin') {
    echo "<h2>Dashboard Admin</h2>";
    echo '<form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama Produk" required>
            <input type="number" name="harga" placeholder="Harga" required>
            <input type="file" name="gambar" required>
            <button type="submit" name="tambah_produk" class="btn">Tambah Produk</button>
          </form><br>';

    echo "<table>
            <tr><th>No</th><th>Nama</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>";
    $query = mysqli_query($conn, "SELECT * FROM produk");
    $no = 1;
    while ($produk = mysqli_fetch_assoc($query)) {
        echo "<tr>
                <td>$no</td>
                <td>{$produk['nama']}</td>
                <td>Rp " . number_format($produk['harga'], 0, ',', '.') . "</td>
                <td><img src='images/{$produk['gambar']}' width='40'></td>
                <td><a href='?hapus_produk={$produk['id']}' class='btn'>Hapus</a></td>
              </tr>";
        $no++;
    }
    echo "</table>";
}
?>

</body>
</html>