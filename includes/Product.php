<?php
class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function all() {
        $stmt = $this->conn->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($name, $category_id, $price) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, category_id, price) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $category_id, $price]);
    }

    public function update($id, $name, $category_id, $price) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, category_id=?, price=? WHERE id=?");
        return $stmt->execute([$name, $category_id, $price, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([$id]);
    }

    // --- EKLENENLER ---
    
    // Tüm kategorileri getir
    public function getAllCategories() {
        $stmt = $this->conn->prepare("SELECT * FROM categories ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Belirli kategoriye ait ürünleri getir
    public function getProductsByCategory($category_id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY name ASC");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>