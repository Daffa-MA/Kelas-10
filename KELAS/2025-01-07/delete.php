<?php
require_once 'Barang.php';

$id = $_GET['id'];

$database = new Database();
$db = $database->conn;

$barang = new Barang($db);
$barang->id = $id;

if ($barang->delete()) {
    echo "Barang berhasil dihapus!";
} else {
    echo "Gagal menghapus barang.";
}
?>
