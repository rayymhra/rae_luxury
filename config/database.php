<?php 

namespace Core;

class Database {
    private $host = "localhost";
    private $dbname = "sch_pinjem_barang_rael";
    private $username = "root";
    private $password = "";
    private $connection;

    public function __construct(){
        $this->connect();
    }

    private function connect() {
        $this->connection = new \mysqli($this->host, $this->username, $this->password, $this->dbname,);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);

        if (!$stmt) {
            die("SQL error: " . $this->connection->error);
        }

        // If there are parameters, bind them dynamically
        if (!empty($params)) {
            $types = '';
            $values = [];

            foreach ($params as $param) {
                $types .= $this->getParamType($param);
                $values[] = $param;
            }

            // Use call_user_func_array to bind params
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();

        // Return results for SELECT or affected rows for INSERT/UPDATE/DELETE
        if (stripos($sql, 'SELECT') === 0) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return $stmt->affected_rows;
        }
    }

    private function getParamType($param) {
        switch (gettype($param)) {
            case 'integer':
                return 'i'; // Integer
            case 'double':
                return 'd'; // Double
            case 'string':
                return 's'; // String
            default:
                return 'b'; // Blob
        }
    }

    public function close() {
        $this->connection->close();
    }
}