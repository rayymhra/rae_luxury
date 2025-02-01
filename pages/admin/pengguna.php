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
        <div class="card mb-4">
            <div class="card-header">Tambah Akun</div>
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
                            <a href="?delete=<?= $p['id'] ?>&role=petugas" class="btn btn-danger btn-sm" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Display User Table -->
        <h3>Daftar User</h3>
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
                            <a href="?delete=<?= $u['id'] ?>&role=user" class="btn btn-danger btn-sm" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
