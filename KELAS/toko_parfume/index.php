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

// Hapus produk dari database
if (isset($_GET['hapus_produk'])) {
    $id_produk = $_GET['hapus_produk'];
    mysqli_query($conn, "DELETE FROM produk WHERE id = $id_produk");
    header("Location: ?page=admin");
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

// Edit produk
if (isset($_POST['edit_produk'])) {
    $id = $_POST['id'];
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    
    // Cek apakah gambar baru diupload
    if ($gambar) {
        // Jika ada gambar baru, upload dan update gambar
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "images/" . $gambar);
        $query = "UPDATE produk SET nama = '$nama', harga = '$harga', gambar = '$gambar' WHERE id = $id";
    } else {
        // Jika tidak ada gambar baru, hanya update nama dan harga
        $query = "UPDATE produk SET nama = '$nama', harga = '$harga' WHERE id = $id";
    }

    mysqli_query($conn, $query);
    header("Location: ?page=admin");
    exit;
}

// Ambil data produk untuk halaman edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id = $id"));
}

// Checkout
if (isset($_POST['checkout'])) {
    // Ambil data dari form checkout
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    
    $total_harga = 0;
    foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
        $produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM produk WHERE id = $id_produk"));
        $total_harga += $produk['harga'] * $jumlah;
    }

    // Simpan data pesanan ke database (misalnya, dalam tabel pesanan)
    // Anda bisa menambahkan logika untuk menyimpan pesanan, alamat, dan total harga ke dalam database di sini.
    echo "<h3>Pesanan berhasil! Total yang harus dibayar: Rp " . number_format($total_harga, 0, ',', '.') . "</h3>";
    unset($_SESSION['keranjang']); // Reset keranjang setelah checkout
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Parfum Online</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color:rgb(57, 57, 57); /* Background abu-abu */
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
            background-color: #2c2c2c;
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

        /* Form Checkout */
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
        }
        .form-container input, .form-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
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
                <tr><th>No</th><th>Gambar</th><th>Produk</th><th>Jumlah</th><th>Aksi</th></tr>";
        $total = 0;
        $no = 1;
        foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
            $produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id = $id_produk"));
            $subtotal = $produk['harga'] * $jumlah;
            $total += $subtotal;
            echo "<tr>
                    <td>$no</td>
                    <td><img src='images/{$produk['gambar']}' width='50' alt='{$produk['nama']}'></td>
                    <td>{$produk['nama']}</td>
                    <td>$jumlah</td>
                    <td><a href='?hapus=$id_produk' class='btn'>Hapus</a></td>
                  </tr>";
            $no++;
        }
        echo "</table>";

        // Form Checkout
        echo '<div class="form-container">
                <h3>Total Pesanan: Rp ' . number_format($total, 0, ',', '.') . '</h3>
                <form action="" method="POST">
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="no_telepon" placeholder="Nomor Telepon" required>
                    <input type="text" name="alamat" placeholder="Masukkan alamat pengiriman" required>
                    <button type="submit" name="checkout" class="btn">Checkout</button>
                </form>
              </div>';
    }
}

// Halaman Admin
elseif ($page == 'admin') {
    echo "<h2>Dashboard Admin</h2>";

    // Form untuk menambah produk baru
    echo '<form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama Produk" required>
            <input type="number" name="harga" placeholder="Harga" required>
            <input type="file" name="gambar" required>
            <button type="submit" name="tambah_produk" class="btn">Tambah Produk</button>
          </form><br>';

    // Tabel produk dengan tombol Edit dan Hapus
    echo "<table>
            <tr><th>No</th><th>Nama</th><th>Harga</th><th>Gambar</th><th>Aksi</th></tr>";
    $query = mysqli_query($conn, "SELECT * FROM produk");
    $no = 1;
    while ($produk = mysqli_fetch_assoc($query)) {
        echo "<tr>
                <td>$no</td>
                <td>{$produk['nama']}</td>
                <td>Rp " . number_format($produk['harga'], 0, ',', '.') . "</td>
                <td><img src='images/{$produk['gambar']}' width='40' alt='{$produk['nama']}'></td>
                <td>
                    <a href='?edit={$produk['id']}' class='btn'>Edit</a>
                    <a href='?hapus_produk={$produk['id']}' class='btn' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk?\")'>Hapus</a>
                </td>
              </tr>";
        $no++;
    }
    echo "</table>";
}

// Halaman Edit Produk
elseif ($page == 'edit') {
    if (isset($produk)) {
        echo '<h2>Edit Produk</h2>
              <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="' . $produk['id'] . '">
                  <input type="text" name="nama" value="' . $produk['nama'] . '" required>
                  <input type="number" name="harga" value="' . $produk['harga'] . '" required>
                  <input type="file" name="gambar">
                  <button type="submit" name="edit_produk" class="btn">Simpan Perubahan</button>
              </form>';
    } else {
        echo "<p>Produk tidak ditemukan!</p>";
    }
}
?>

</body>
</html>