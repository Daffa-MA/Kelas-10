<?php
require_once 'Barang.php';

$database = new Database();
$db = $database->conn;

$barang = new Barang($db);
$stmt = $barang->read();

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['harga']}</td>
            <td>{$row['stok']}</td>
            <td><img src='images/{$row['gambar']}' width='100' height='100'></td>
            <td>
                <a href='update.php?id={$row['id']}'>Update</a> |
                <a href='delete.php?id={$row['id']}'>Delete</a>
            </td>
          </tr>";
}

echo "</table>";
?>
