<?php
use Core\Database;
include '../../config/database.php';
include '../../templates/sidebar.php';

$db = Database::getInstance()->getConnection();

// Default: Show all transactions
$filter_sql = "";
if (isset($_GET['start_date']) && isset($_GET['end_date']) && !empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $filter_sql = " WHERE p.tanggal_pinjam BETWEEN '$start_date' AND '$end_date'";
}

// Fetch laporan data
$query = "SELECT p.*, u.nama_user AS nama_user, b.nama_barang 
          FROM peminjaman p
          JOIN user u ON p.id_user = u.id
          JOIN barang b ON p.id_barang = b.id
          $filter_sql
          ORDER BY p.id DESC";

$result = $db->query($query);
?>

<div class="container mt-4">
    <h2>Laporan Peminjaman & Pengembalian</h2>

    <!-- Filter Form -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label>Dari Tanggal:</label>
                <input type="date" name="start_date" class="form-control" value="<?= $_GET['start_date'] ?? '' ?>" required>
            </div>
            <div class="col-md-4">
                <label>Sampai Tanggal:</label>
                <input type="date" name="end_date" class="form-control" value="<?= $_GET['end_date'] ?? '' ?>" required>
            </div>
            <div class="col-md-4">
                <br>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
                <a href="laporan.php" class="btn btn-secondary mt-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Table Data -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <!-- <th>Tanggal Kembali</th> -->
                <th>Status</th>
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
                    <!-- <td><?= $row['tanggal_kembali'] ?: '-' ?></td> -->
                    <td>
                        <?php if ($row['status'] == 'Dipinjam') : ?>
                            <span class="badge bg-warning"><?= $row['status'] ?></span>
                        <?php else : ?>
                            <span class="badge bg-success"><?= $row['status'] ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
