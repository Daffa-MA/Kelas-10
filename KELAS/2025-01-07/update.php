<?php
require_once 'Barang.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_FILES['gambar']['name'];

    // Upload image
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'images/' . $gambar);

    $database = new Database();
    $db = $database->conn;

    $barang = new Barang($db);
    $barang->id = $id;
    $barang->nama_barang = $nama_barang;
    $barang->harga = $harga;
    $barang->stok = $stok;
    $barang->gambar = $gambar;

    if ($barang->update()) {
        echo "Barang berhasil diperbarui!";
    } else {
        echo "Gagal memperbarui barang.";
    }
} else {
    $id = $_GET['id'];
    $database = new Database();
    $db = $database->conn;

    $barang = new Barang($db);
    $barang->id = $id;
    $stmt = $barang->readOne();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<form action="update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    Nama Barang: <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required><br>
    Harga: <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required><br>
    Stok: <input type="number" name="stok" value="<?php echo $row['stok']; ?>" required><br>
    Gambar: <input type="file" name="gambar"><br>
    <input type="submit" value="Perbarui Barang">
</form>
