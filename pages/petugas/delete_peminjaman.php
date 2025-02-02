<?php
use Core\Database;
include '../../config/database.php';

$db = Database::getInstance()->getConnection();

if (!isset($_GET['id'])) {
    echo "<script>alert('ID peminjaman tidak ditemukan!'); window.location.href='peminjaman.php';</script>";
    exit;
}

$id = $_GET['id'];

// Delete query
$query = "DELETE FROM peminjaman WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Peminjaman berhasil dihapus!'); window.location.href='peminjaman.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: " . $db->error . "');</script>";
}
?>
