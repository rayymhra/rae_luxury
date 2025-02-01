<?php
session_start();
require_once '../../config/database.php';
require_once '../../classes/core/auth.php';

$auth = new Core\Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($auth->login($username, $password, 'admin')) {
        header("Location: dashboard.php");
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
    <link rel="stylesheet" href="../../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-login-dasar">
        <div class="container login-container d-flex justify-content-center align-items-center flex-column">
            <div class="ingfo text-center">
                <img src="../../assets/img/Rael.png" alt="" class="logo-login w-50">
                <h6 class="text-white">Welcome Back Admin! Please enter your details</h6>
                <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
            </div>
            <div class="login-form-admin mt-4">
                <form method="POST" action="" class="form-form-login-admin">
                    <div class="mb-3">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required class="form-control w-100" placeholder="Enter your username">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required class="form-control w-100" placeholder="Enter your password">
                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" class="btn btn-warning w-50">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>