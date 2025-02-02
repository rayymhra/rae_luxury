<?php
use Core\Database;
include '../../config/database.php';
include '../../templates/petugas_sidebar.php';

$db = Database::getInstance()->getConnection();

// Handle return request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_peminjaman'])) {
    $id_peminjaman = $_POST['id_peminjaman'];

    // Fetch peminjaman data
    $query = "SELECT * FROM peminjaman WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id_peminjaman);
    $stmt->execute();
    $result = $stmt->get_result();
    $peminjaman = $result->fetch_assoc();

    if ($peminjaman) {
        // Update status to 'Dikembalikan'
        $updateQuery = "UPDATE peminjaman SET status = 'Dikembalikan' WHERE id = ?";
        $stmt = $db->prepare($updateQuery);
        $stmt->bind_param("i", $id_peminjaman);
        $stmt->execute();

        // Update barang stock
        $updateStock = "UPDATE barang SET jumlah = jumlah + ? WHERE id = ?";
        $stmt = $db->prepare($updateStock);
        $stmt->bind_param("ii", $peminjaman['jumlah'], $peminjaman['id_barang']);
        $stmt->execute();

        echo "<script>alert('Barang berhasil dikembalikan!'); window.location.href='pengembalian.php';</script>";
    } else {
        echo "<script>alert('Data peminjaman tidak ditemukan!');</script>";
    }
}

// Fetch borrowed items that haven't been returned
$result = $db->query("SELECT p.*, u.nama_user, b.nama_barang 
    FROM peminjaman p 
    JOIN user u ON p.id_user = u.id
    JOIN barang b ON p.id_barang = b.id 
    WHERE p.status = 'Dipinjam'
    ORDER BY p.id DESC");
?>

<div class="container mt-4">
    <h2>Pengembalian Barang</h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama_user'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['tanggal_pinjam'] ?></td>
                    <td><span class="badge bg-warning"><?= $row['status'] ?></span></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id_peminjaman" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-success btn-sm">Kembalikan</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
