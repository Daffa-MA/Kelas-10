<?php
require_once 'Barang.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar']['name'];

    // Upload image
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'images/' . $gambar);

    $database = new Database();
    $db = $database->conn;

    $barang = new Barang($db);
    $barang->nama_barang = $nama_barang;
    $barang->harga = $harga;
    $barang->stok = $stok;
    $barang->gambar = $gambar;

    if ($barang->create()) {
        echo "Barang berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan barang.";
    }
}
?>

<form action="create.php" method="post" enctype="multipart/form-data">
    Nama Barang: <input type="text" name="nama_barang" required><br>
    Harga: <input type="number" name="harga" required><br>
    Stok: <input type="number" name="stok" required><br>
    Gambar: <input type="file" name="gambar" required><br>
    <input type="submit" value="Tambah Barang">
</form>
