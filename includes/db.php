<?php
require_once 'config.php';

class Database {
    private $host = 'localhost';
    private $db = 'restoran_db';
    private $user = 'root';
    private $pass = '';
    private $conn;

    public function getConnection() {
        if ($this->conn) return $this->conn;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Veritabanı bağlantı hatası: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>