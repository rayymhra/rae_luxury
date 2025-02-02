<?php
require '../../config/database.php';
require '../../classes/core/auth.php';

use Core\Auth;

// Start session
session_start();

$auth = new Auth();
$auth->logout();

header('Location: login.php');
exit;
