<?php
require_once '../../classes/core/auth.php';
require_once '../../config/database.php';
require_once '../../classes/admin/add_admin.php';

use Admin\AddAdmin;

// Ensure the admin is logged in
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: login.php');
//     exit();
// }

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $nama_admin = $_POST['nama_admin'] ?? '';

    if ($username && $password && $nama_admin) {
        if (AddAdmin::createAdmin($username, $password, $nama_admin)) {
            $message = 'Admin successfully added!';
        } else {
            $message = 'Failed to add admin.';
        }
    } else {
        $message = 'All fields are required.';
    }
}

use Core\Database;

$conn = Database::getInstance()->getConnection();

$users = $conn->query("SELECT * FROM admin")->fetch_all(MYSQLI_ASSOC);

?>

<?php include '../../templates/sidebar.php'; ?>
<div class="container mt-4">
    <div class="card shadow-lg p-4 mb-5">
        <h2 class="mb-3 text-center">Add Admin</h2>

        <?php if ($message): ?>
            <div class="alert <?php echo $alertClass; ?> text-center">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="add_admin.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nama_admin" class="form-label">Nama Admin:</label>
                <input type="text" id="nama_admin" name="nama_admin" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Admin</button>
        </form>
    </div>

    <h3>Daftar User</h3>
        <div class="card">
            <div class="card-header header-card-dark">
                Daftar User
            </div>
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
                                <td><?= $u['nama_admin'] ?></td>
                                <td><?= $u['username'] ?></td>
                                <td>
                                    <a href="?delete=<?= $u['id'] ?>&role=user" class="btn btn-primary btn-sm" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<?php include '../../templates/footer.php'; ?>
