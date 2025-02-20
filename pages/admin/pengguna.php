<?php
session_start();
require_once '../../config/database.php';
require_once '../../classes/core/auth.php';

// Redirect if not logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

use Core\Database;


$conn = Database::getInstance()->getConnection();

// Fetch petugas and users
$petugas = $conn->query("SELECT * FROM petugas")->fetch_all(MYSQLI_ASSOC);
$users = $conn->query("SELECT * FROM user")->fetch_all(MYSQLI_ASSOC);

// Handle adding new accounts
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_account'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $role = $_POST['role'];

    if ($role === 'petugas') {
        $query = "INSERT INTO petugas (username, password, nama_petugas) VALUES (?, ?, ?)";
    } elseif ($role === 'user') {
        $query = "INSERT INTO user (username, password, nama_user) VALUES (?, ?, ?)";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $name);
    $stmt->execute();
    header("Location: pengguna.php");
    exit;
}

// Handle updating accounts
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_account'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    if ($role === 'petugas') {
        $query = "UPDATE petugas SET username=?, nama_petugas=? WHERE id=?";
    } elseif ($role === 'user') {
        $query = "UPDATE user SET username=?, nama_user=? WHERE id=?";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $username, $name, $id);
    $stmt->execute();
    header("Location: pengguna.php");
    exit;
}

// Handle deleting accounts
if (isset($_GET['delete']) && isset($_GET['role'])) {
    $id = $_GET['delete'];
    $role = $_GET['role'];

    if ($role === 'petugas') {
        $conn->query("DELETE FROM petugas WHERE id = $id");
    } elseif ($role === 'user') {
        $conn->query("DELETE FROM user WHERE id = $id");
    }
    header("Location: pengguna.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Manajemen Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include "../../templates/sidebar.php" ?>
    <div class="container mt-5">
        <h2>Manajemen Pengguna</h2>

        <!-- Add New Account Form -->
        <div class="card mb-5">
            <div class="card-header header-card-dark">Tambah Akun</div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="petugas">Petugas</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="submit" name="add_account" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>

        <!-- Display Petugas Table -->
        <h3>Daftar Petugas</h3>
        <div class="card mb-5">
            <div class="card-header header-card-dark">Daftar Petugas</div>
            <div class="card-body">
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($petugas as $p) : ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nama_petugas'] ?></td>
                        <td><?= $p['username'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="fillEditForm('<?= $p['id'] ?>', '<?= $p['nama_petugas'] ?>', '<?= $p['username'] ?>', 'petugas')">Edit</button>
                            <a href="?delete=<?= $p['id'] ?>&role=petugas" class="btn btn-primary btn-sm" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
            </div>
        </div>
        

        <!-- Display User Table -->
        <h3>Daftar User</h3>
        <div class="card">
            <div class="card-header header-card-dark">Daftar User</div>
            <div class="card-body">
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u) : ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nama_user'] ?></td>
                        <td><?= $u['username'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="fillEditForm('<?= $u['id'] ?>', '<?= $u['nama_user'] ?>', '<?= $u['username'] ?>', 'user')">Edit</button>
                            <a href="?delete=<?= $u['id'] ?>&role=user" class="btn btn-primary btn-sm" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
            </div>
        </div>
        
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="role" id="edit_role">
                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label>Username</label>
                            <input type="text" name="username" id="edit_username" class="form-control" required>
                        </div>
                        <button type="submit" name="edit_account" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php include '../../templates/footer.php'; ?>
    <script>
        function fillEditForm(id, name, username, role) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_role').value = role;

            // Debugging: Check if values are set properly
            console.log("ID:", id);
            console.log("Name:", name);
            console.log("Username:", username);
            console.log("Role:", role);
        }
    </script>


</body>

</html>