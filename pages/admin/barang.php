<?php
include '../../templates/sidebar.php';
require_once '../../classes/admin/barang.php';
require_once '../../config/database.php';

$barangObj = new Barang(); 
$barangList = $barangObj->getAllBarang();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $nama = $_POST['nama_barang'];
    $brand = $_POST['brand'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    if ($barangObj->addBarang($nama, $brand, $deskripsi, $kategori, $jumlah, $status)) {
        header("Location: barang.php?success=Barang berhasil ditambahkan!");
        exit();
    } else {
        $error = "Gagal menambahkan barang.";
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($barangObj->deleteBarang($id)) {
        header("Location: barang.php?success=Barang berhasil dihapus!");
        exit();
    } else {
        $error = "Gagal menghapus barang.";
    }
}
?>

<div class="container mt-4">
    <h1>Manajemen Barang</h1>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Form Tambah Barang -->
    <div class="card p-3 mb-4">
        <h3>Tambah Barang</h3>
        <form method="POST" action="barang.php">
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Brand</label>
                <input type="text" class="form-control" name="brand" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" name="kategori">
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-control" name="status" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Tambah Barang</button>
        </form>
    </div>

    <!-- Tabel Barang -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Brand</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barangList as $index => $barang): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($barang['brand']); ?></td>
                    <td><?php echo htmlspecialchars($barang['kategori']); ?></td>
                    <td><?php echo $barang['jumlah']; ?></td>
                    <td><?php echo htmlspecialchars($barang['status']); ?></td>
                    <td><?php echo htmlspecialchars($barang['deskripsi']); ?></td>
                    <td>
                        <a href="barang.php?delete=<?php echo $barang['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../../templates/footer.php'; ?>
