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
    $harga = $_POST['harga'];

    if ($barangObj->addBarang($nama, $brand, $deskripsi, $kategori, $jumlah, $status, $harga)) {
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


// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id_barang'];
    $nama = $_POST['nama_barang'];
    $brand = $_POST['brand'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];

    if ($barangObj->updateBarang($id, $nama, $brand, $deskripsi, $kategori, $jumlah, $status, $harga)) {
        header("Location: barang.php?success=Barang berhasil diperbarui!");
        exit();
    } else {
        $error = "Gagal memperbarui barang.";
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
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" step="0.01" class="form-control" name="harga" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Tambah Barang</button>
        </form>
    </div>

    <!-- Tabel Barang -->
     <div class="card">
        <div class="card-header header-card-dark">
            Data Barang
        </div>
        <div class="card-body">
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
                <th>Harga</th>
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
                    <td><?php echo $barang['harga']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $barang['id']; ?>">Edit</button>
                        <a href="barang.php?delete=<?php echo $barang['id']; ?>" class="btn btn-primary btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?php echo $barang['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="barang.php">
                                <div class="modal-body">
                                    <input type="hidden" name="id_barang" value="<?php echo $barang['id']; ?>">
                                    <div class="mb-3">
                                        <label>Nama Barang</label>
                                        <input type="text" class="form-control" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Brand</label>
                                        <input type="text" class="form-control" name="brand" value="<?php echo $barang['brand']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi"><?php echo $barang['deskripsi']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Kategori</label>
                                        <input type="text" class="form-control" name="kategori" value="<?php echo $barang['kategori']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah" value="<?php echo $barang['jumlah']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga" value="<?php echo $barang['harga']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="Tersedia" <?php echo ($barang['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                            <option value="Dipinjam" <?php echo ($barang['status'] == 'Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                                            <option value="Rusak" <?php echo ($barang['status'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
     </div>
    
</div>




<?php include '../../templates/footer.php'; ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>