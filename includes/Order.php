<?php
class Order {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getOpenByTable($table_id) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE table_id = ? AND status = 'Açık' LIMIT 1");
        $stmt->execute([$table_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($table_id) {
        $stmt = $this->conn->prepare("INSERT INTO orders (table_id, status) VALUES (?, 'Açık')");
        $stmt->execute([$table_id]);
        return $this->conn->lastInsertId();
    }

    public function completeSimple($order_id) {
        $stmt = $this->conn->prepare("UPDATE orders SET status='Kapalı' WHERE id = ?");
        return $stmt->execute([$order_id]);
    }

    public function complete($order_id, $payment_type, $user_id) {
        $stmt = $this->conn->prepare("UPDATE orders SET status='Kapalı', payment_type=?, closed_by=?, closed_at=NOW() WHERE id = ?");
        return $stmt->execute([$payment_type, $user_id, $order_id]);
    }

    // BURASI DEĞİŞTİ!
    public function addProduct($order_id, $product_id, $qty) {
        // Önce aynı ürün zaten var mı kontrol et
        $stmt = $this->conn->prepare("SELECT id, qty FROM order_items WHERE order_id = ? AND product_id = ?");
        $stmt->execute([$order_id, $product_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Varsa sadece miktarı artır
            $stmt2 = $this->conn->prepare("UPDATE order_items SET qty = qty + ? WHERE id = ?");
            return $stmt2->execute([$qty, $row['id']]);
        } else {
            // Yoksa yeni ekle
            $stmt2 = $this->conn->prepare("INSERT INTO order_items (order_id, product_id, qty) VALUES (?, ?, ?)");
            return $stmt2->execute([$order_id, $product_id, $qty]);
        }
    }

    public function getItems($order_id) {
        $stmt = $this->conn->prepare("SELECT oi.*, p.name, p.price FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteItem($item_id) {
        $stmt = $this->conn->prepare("DELETE FROM order_items WHERE id=?");
        return $stmt->execute([$item_id]);
    }

    public function setTableStatus($table_id, $status) {
        $stmt = $this->conn->prepare("UPDATE tables SET status=? WHERE id=?");
        return $stmt->execute([$status, $table_id]);
    }

    public function getById($order_id) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$order_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>