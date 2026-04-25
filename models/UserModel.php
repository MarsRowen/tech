<?php
// models/UserModel.php
require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel {
    public function addUser($email, $hash, $name, $role) {
        $stmt = $this->db->prepare('INSERT INTO users (email, password, name, role) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$email, $hash, $name, $role]);
    }

    public function getUsers() {
        return $this->db->query('SELECT id, email, name, role, created_at FROM users ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>