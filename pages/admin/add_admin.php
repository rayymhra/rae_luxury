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

use Core\Database;
$conn = Database::getInstance()->getConnection(); // Ensure this is present



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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_admin'])) {
    $edit_id = $_POST['edit_id'] ?? '';
    $edit_nama_admin = $_POST['edit_nama_admin'] ?? '';
    $edit_username = $_POST['edit_username'] ?? '';
    $edit_password = $_POST['edit_password'] ?? '';

    if ($edit_id && $edit_nama_admin && $edit_username) {
        // Ensure the database connection is used
        $conn = Database::getInstance()->getConnection();

        $sql = "UPDATE admin SET nama_admin = ?, username = ?" . ($edit_password ? ", password = ?" : "") . " WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($edit_password) {
            $hashed_password = password_hash($edit_password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssi", $edit_nama_admin, $edit_username, $hashed_password, $edit_id);
        } else {
            $stmt->bind_param("ssi", $edit_nama_admin, $edit_username, $edit_id);
        }

        if ($stmt->execute()) {
            $message = "Admin updated successfully!";
        } else {
            $message = "Failed to update admin.";
        }
    } else {
        $message = "All fields are required.";
    }
}

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
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAdminModal"
                                    onclick="fillEditForm('<?= $u['id'] ?>', '<?= htmlspecialchars($u['nama_admin'], ENT_QUOTES) ?>', '<?= htmlspecialchars($u['username'], ENT_QUOTES) ?>')">
                                    Edit
                                </button>
                                <a href="?delete=<?= $u['id'] ?>&role=user" class="btn btn-primary btn-sm" onclick="return confirm('Hapus akun ini?')">Hapus</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAdminForm" method="POST">
                        <input type="hidden" name="edit_id" id="edit_id">

                        <div class="mb-3">
                            <label for="edit_nama_admin" class="form-label">Nama Admin:</label>
                            <input type="text" id="edit_nama_admin" name="edit_nama_admin" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_username" class="form-label">Username:</label>
                            <input type="text" id="edit_username" name="edit_username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_password" class="form-label">New Password (Optional):</label>
                            <input type="password" id="edit_password" name="edit_password" class="form-control">
                        </div>

                        <button type="submit" name="update_admin" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function fillEditForm(id, nama_admin, username) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nama_admin').value = nama_admin;
        document.getElementById('edit_username').value = username;
    }
</script>

<?php include '../../templates/footer.php'; ?>