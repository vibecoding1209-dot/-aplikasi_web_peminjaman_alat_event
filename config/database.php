<?php
// File: config/database.php
// Koneksi database menggunakan MySQLi dengan prepared statements

class Database {
    private $host = 'localhost';
    private $db_name = 'db_rental_alat';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            // Set charset ke UTF-8
            $this->conn->set_charset("utf8mb4");

            // Check connection
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            die("Maaf, terjadi kesalahan pada database. Silahkan coba lagi nanti.");
        }

        return $this->conn;
    }

    // Method untuk prepared statement
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    // Method untuk escape string
    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }

    // Method untuk mendapatkan last insert ID
    public function lastInsertId() {
        return $this->conn->insert_id;
    }

    // Method untuk transaction
    public function beginTransaction() {
        $this->conn->begin_transaction();
    }

    public function commit() {
        $this->conn->commit();
    }

    public function rollback() {
        $this->conn->rollback();
    }
}

// Singleton pattern untuk koneksi database
$database = new Database();
$db = $database->getConnection();

// Fungsi helper untuk query cepat
function query($sql, $params = [], $types = "") {
    global $db;
    $stmt = $db->prepare($sql);

    if ($stmt === false) {
        error_log("Query prepare error: " . $db->error);
        return false;
    }

    if (!empty($params)) {
        if (empty($types)) {
            $types = str_repeat('s', count($params));
        }
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();

    // Untuk SELECT query
    if (strpos(strtoupper($sql), 'SELECT') === 0) {
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    // Untuk INSERT, UPDATE, DELETE
    $affected_rows = $stmt->affected_rows;
    $insert_id = $stmt->insert_id;
    $stmt->close();

    return ['affected_rows' => $affected_rows, 'insert_id' => $insert_id];
}

// Fungsi untuk mendapatkan single row
function queryOne($sql, $params = [], $types = "") {
    $result = query($sql, $params, $types);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Fungsi untuk mendapatkan semua rows
function queryAll($sql, $params = [], $types = "") {
    $result = query($sql, $params, $types);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}
?>
