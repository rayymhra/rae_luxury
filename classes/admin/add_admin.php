<?php
namespace Admin;

use Core\Database;

class AddAdmin {
    public static function createAdmin($username, $password, $nama_admin) {
        // Get database instance correctly
        $db = Database::getInstance()->getConnection();

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Use prepared statements for security
        $stmt = $db->prepare("INSERT INTO admin (username, password, nama_admin) VALUES (?, ?, ?)");

        if (!$stmt) {
            die("SQL Error: " . $db->error);
        }

        $stmt->bind_param("sss", $username, $hashed_password, $nama_admin);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
