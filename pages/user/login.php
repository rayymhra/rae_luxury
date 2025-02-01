<?php
session_start();
require_once '../../config/database.php';
require_once '../../classes/core/auth.php';

$auth = new Core\Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($auth->login($username, $password, 'user')) {
        header("Location: list_barang.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>User Login</h2>
        <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" class="form-control mb-2" required>
            <input type="password" name="password" placeholder="Password" class="form-control mb-2" required>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
