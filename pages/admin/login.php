<?php
require '../../config/database.php';
require '../../classes/core/auth.php';

use Core\Auth;

// Start session
session_start();

// Check if already logged in
$auth = new Auth();
if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($auth->login($username, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Login</title>
</head>
<body>
    <h1>Login Admin</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
