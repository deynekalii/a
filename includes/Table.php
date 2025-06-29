<?php
class Table {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM tables ORDER BY group_name ASC, id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id) {
        $stmt = $this->db->prepare("SELECT * FROM tables WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($name, $group_name = "İç Mekan") {
        $stmt = $this->db->prepare("INSERT INTO tables (name, group_name) VALUES (?, ?)");
        return $stmt->execute([$name, $group_name]);
    }

    public function update($id, $name, $group_name) {
        $stmt = $this->db->prepare("UPDATE tables SET name=?, group_name=? WHERE id=?");
        return $stmt->execute([$name, $group_name, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tables WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function setFree($id) {
        $stmt = $this->db->prepare("UPDATE tables SET status='Boş' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findByGroup($group_name) {
        $stmt = $this->db->prepare("SELECT * FROM tables WHERE group_name = ? ORDER BY id ASC");
        $stmt->execute([$group_name]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>