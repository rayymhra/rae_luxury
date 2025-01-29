<?php
require_once '../../config/database.php';

use Core\Database;

class Barang {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllBarang() {
        $query = "SELECT * FROM barang";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addBarang($nama, $brand, $deskripsi, $kategori, $jumlah, $status) {
        $query = "INSERT INTO barang (nama_barang, brand, deskripsi, kategori, jumlah, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssis", $nama, $brand, $deskripsi, $kategori, $jumlah, $status);
        return $stmt->execute();
    }

    public function deleteBarang($id) {
        $query = "DELETE FROM barang WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
