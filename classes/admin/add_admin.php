<?php
namespace Admin;

use Core\Database;

class AddAdmin {
    public static function createAdmin($username, $password, $nama_admin) {
        $db = new Database();

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert admin into the database
        $sql = "INSERT INTO admin (username, password, nama_admin) VALUES (?, ?, ?)";
        $params = [$username, $hashed_password, $nama_admin];

        return $db->query($sql, $params);
    }
}
