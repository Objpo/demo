<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "shoestore_db";
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (!$this->conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }
    }

    // hash pass
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // hash pass
    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

}
?>