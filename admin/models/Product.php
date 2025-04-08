<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll($page = 1, $limit = 5) {
        $start = ($page - 1) * $limit;
        $query = "SELECT * FROM products LIMIT $start, $limit";
        return mysqli_query($this->db->conn, $query);
    }

    public function getTotal() {
        $query = "SELECT COUNT(*) as total FROM products";
        $result = mysqli_query($this->db->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    public function getById($id) {
        $query = "SELECT * FROM products WHERE id=$id";
        $result = mysqli_query($this->db->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function add($name, $price) {
        $name = mysqli_real_escape_string($this->db->conn, $name);
        $query = "INSERT INTO products (name, price) VALUES ('$name', '$price')";
        return mysqli_query($this->db->conn, $query);
    }

    public function update($id, $name, $price) {
        $name = mysqli_real_escape_string($this->db->conn, $name);
        $query = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
        return mysqli_query($this->db->conn, $query);
    }

    public function delete($id) {
        $query = "DELETE FROM products WHERE id=$id";
        return mysqli_query($this->db->conn, $query);
    }
}
?>