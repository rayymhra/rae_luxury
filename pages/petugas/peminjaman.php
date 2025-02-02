<?php
use Core\Database;

include '../../config/database.php';
include '../../templates/petugas_sidebar.php';

$db = Database::getInstance()->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal_pinjam = date("Y-m-d");
    $status = "Dipinjam"; // Default status

    $query = "INSERT INTO peminjaman (id_user, id_barang, jumlah, tanggal_pinjam, status) 
              VALUES (?, ?, ?, ?, ?)";

    $stmt = $db->prepare($query);
    $stmt->bind_param("iiiss", $id_user, $id_barang, $jumlah, $tanggal_pinjam, $status);
    if ($stmt->execute()) {
        echo "<script>alert('Peminjaman berhasil!'); window.location.href='peminjaman.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $db->error . "');</script>";
    }
}
$result = $db->query("SELECT p.*, u.nama_user, b.nama_barang 
    FROM peminjaman p 
    JOIN user u ON p.id_user = u.id
    JOIN barang b ON p.id_barang = b.id 
    ORDER BY p.id DESC");

$users = $db->query("SELECT * FROM user");
$items = $db->query("SELECT * FROM barang WHERE jumlah > 0");

?>

<div class="container mt-4">
    <h2>Peminjaman Barang</h2>
    
    <!-- Form Peminjaman -->
    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label>Nama User:</label>
                <select name="id_user" class="form-control" required>
                    <option value="">-- Pilih User --</option>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user['id'] ?>"><?= $user['nama_user'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label>Nama Barang:</label>
                <select name="id_barang" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($items as $item) : ?>
                        <option value="<?= $item['id'] ?>">
                            <?= $item['nama_barang'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label>Jumlah:</label>
                <input type="number" name="jumlah" class="form-control" required min="1">
            </div>

            <div class="col-md-2">
                <br>
                <button type="submit" class="btn btn-primary mt-2">Tambah Peminjaman</button>
            </div>
        </div>
    </form>

    <!-- Table Data Peminjaman -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama_user'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['tanggal_pinjam'] ?></td>
                    <td><span class="badge bg-warning"><?= $row['status'] ?></span></td>
                    <td>
                        <a href="edit_peminjaman.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_peminjaman.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
