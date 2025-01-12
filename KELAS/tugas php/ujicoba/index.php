<?php
require_once 'Barang.php';

$barang = new Barang();

$barang_edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $barang_edit = $barang->readOne($id); // Pastikan Anda memiliki fungsi readOne di kelas Barang
}


// Create
if (isset($_POST['create'])) {
    $barang->create($_POST['nama_barang'], $_POST['harga'], $_POST['stok'], $_POST['gambar']);
}


// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = $_POST['gambar'];

    if (!empty($id) && !empty($nama_barang) && !empty($harga) && !empty($stok)) {
        $barang->update($id, $nama_barang, $harga, $stok, $gambar);
        header("Location: index.php"); // Redirect kembali ke halaman utama
    } else {
        echo "Data tidak valid!";
    }
}


// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // Pastikan key 'delete' ada
    if (!empty($id)) {
        $barang->delete($id);
    } else {
        echo "ID tidak valid untuk delete.";
    }
}

// Read all data
$data_barang = $barang->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dbgpt</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>TUGAS PHP</h1>


        <form method="POST" action="index.php">
            <input type="hidden" name="id" value="<?= isset($barang_edit) ? $barang_edit['id'] : ''; ?>">
            <input type="text" name="nama_barang" placeholder="Nama Barang" value="<?= isset($barang_edit) ? $barang_edit['nama_barang'] : ''; ?>" required>
            <input type="number" name="harga" placeholder="Harga" value="<?= isset($barang_edit) ? $barang_edit['harga'] : ''; ?>" required>
            <input type="number" name="stok" placeholder="Stok" value="<?= isset($barang_edit) ? $barang_edit['stok'] : ''; ?>" required>
            <input type="text" name="gambar" placeholder="URL Gambar" value="<?= isset($barang_edit) ? $barang_edit['gambar'] : ''; ?>">
            <button type="submit" name="<?= isset($barang_edit) ? 'update' : 'create'; ?>">
                <?= isset($barang_edit) ? 'Update Barang' : 'Tambah Barang'; ?>
            </button>
        </form>



        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_barang as $item): ?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['nama_barang']; ?></td>
                    <td><?= $item['harga']; ?></td>
                    <td><?= $item['stok']; ?></td>
                    <td><img src="<?= $item['gambar']; ?>" alt="Gambar" width="50"></td>
                    <td>
                        <a href="?edit=<?= $item['id']; ?>" class="btn-edit">Edit</a>
                        <a href="?delete=<?= $item['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn-delete">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
