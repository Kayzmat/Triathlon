<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function authenticate($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':password' => md5($password) // Note: En production, utiliser password_hash()
        ]);
        return $stmt->fetch();
    }

    public function getById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getAll() {
        $sql = "SELECT * FROM users ORDER BY name";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO users (name, email, password, role, club_id) VALUES (:name, :email, :password, :role, :club_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => md5($data['password']),
            ':role' => $data['role'],
            ':club_id' => $data['club_id'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET name = :name, email = :email, role = :role, club_id = :club_id WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':role' => $data['role'],
            ':club_id' => $data['club_id'] ?? null
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
