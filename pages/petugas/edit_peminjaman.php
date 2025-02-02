<?php
use Core\Database;
include '../../config/database.php';
include '../../templates/petugas_sidebar.php';

$db = Database::getInstance()->getConnection();

if (!isset($_GET['id'])) {
    echo "<script>alert('ID peminjaman tidak ditemukan!'); window.location.href='peminjaman.php';</script>";
    exit;
}

$id = $_GET['id'];

// Fetch existing data
$query = "SELECT * FROM peminjaman WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$peminjaman = $result->fetch_assoc();

if (!$peminjaman) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='peminjaman.php';</script>";
    exit;
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE peminjaman SET jumlah = ?, status = ? WHERE id = ?";
    $stmt = $db->prepare($updateQuery);
    $stmt->bind_param("isi", $jumlah, $status, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Peminjaman berhasil diperbarui!'); window.location.href='peminjaman.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $db->error . "');</script>";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Peminjaman</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" class="form-control" required min="1" value="<?= $peminjaman['jumlah'] ?>">
        </div>

        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Dipinjam" <?= $peminjaman['status'] == 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                <option value="Dikembalikan" <?= $peminjaman['status'] == 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
                <option value="Hilang" <?= $peminjaman['status'] == 'Hilang' ? 'selected' : '' ?>>Hilang</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
