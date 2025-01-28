<?php
namespace Core;

use Core\Database;

class Auth {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM admin WHERE username = ?";
        $admin = $this->db->query($query, [$username]);

        if ($admin) {
            // Verify the password
            if (password_verify($password, $admin[0]['password'])) {
                // Set session
                $_SESSION['admin_id'] = $admin[0]['id_admin'];
                $_SESSION['nama_admin'] = $admin[0]['nama_admin'];
                return true;
            }
        }

        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['admin_id']);
    }

    public function logout() {
        session_destroy();
    }
}
