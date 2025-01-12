<?php
require_once 'Database.php';

class Barang {
    private $conn;
    private $table_name = "barang";

    public $id;
    public $nama_barang;
    public $harga;
    public $stok;
    public $gambar;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Barang
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nama_barang, harga, stok, gambar) VALUES (:nama_barang, :harga, :stok, :gambar)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":gambar", $this->gambar);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read Barang
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Update Barang
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_barang = :nama_barang, harga = :harga, stok = :stok, gambar = :gambar WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":gambar", $this->gambar);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete Barang
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get a single Barang
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt;
    }
}
?>
