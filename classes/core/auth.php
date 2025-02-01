<?php
namespace Core;

use Core\Database;

class Auth {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function login($username, $password, $role) {
        // Determine which table to query based on role
        if ($role === 'admin') {
            $query = "SELECT * FROM admin WHERE username = ?";
        } elseif ($role === 'petugas') {
            $query = "SELECT * FROM petugas WHERE username = ?";
        } elseif ($role === 'user') {
            $query = "SELECT * FROM user WHERE username = ?";
        } else {
            return false; // Invalid role
        }

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $role;

                return true;
            }
        }

        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
    }
}
?>
