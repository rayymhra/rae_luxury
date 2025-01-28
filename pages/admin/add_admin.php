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
?>

<?php include '../../templates/sidebar.php'; ?>
<div class="container">
    <h1>Add Admin</h1>
    <p><?php echo htmlspecialchars($message); ?></p>
    <form action="add_admin.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="nama_admin">Nama Admin:</label>
            <input type="text" id="nama_admin" name="nama_admin" required>
        </div>
        <button type="submit">Add Admin</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</div>
<?php include '../../templates/footer.php'; ?>
