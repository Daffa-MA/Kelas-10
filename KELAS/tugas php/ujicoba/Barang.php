<?php
require_once 'Database.php';

class Barang {
    private $conn;
    private $table = "barang";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Create
    public function create($nama_barang, $harga, $stok, $gambar) {
        $sql = "INSERT INTO $this->table (nama_barang, harga, stok, gambar) VALUES (:nama_barang, :harga, :stok, :gambar)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nama_barang', $nama_barang);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':gambar', $gambar);
        return $stmt->execute();
    }

    // Read
    public function readAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Update
    public function update($id, $nama_barang, $harga, $stok, $gambar) {
        $sql = "UPDATE $this->table SET 
                    nama_barang = :nama_barang, 
                    harga = :harga, 
                    stok = :stok, 
                    gambar = :gambar 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nama_barang', $nama_barang);
        $stmt->bindParam(':harga', $harga);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':gambar', $gambar);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function readOne($id) {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Delete
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
