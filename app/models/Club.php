<?php
require_once __DIR__ . '/../core/Database.php';

class Club {
    protected $db;

    public function __construct() {
        // Utiliser le singleton Database (retourne un objet PDO)
        $this->db = Database::getInstance();
        $this->ensureTable();
    }

    protected function ensureTable() {
        // création minimale de la table clubs pour éviter les erreurs si elle n'existe pas
        $sql = "CREATE TABLE IF NOT EXISTS clubs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            address VARCHAR(255),
            city VARCHAR(100) NOT NULL DEFAULT '',
            phone VARCHAR(20),
            email VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $this->db->exec($sql);
    }

    public function getAll() {
        $sql = "SELECT * FROM clubs ORDER BY name";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM clubs WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getByName($name) {
        $sql = "SELECT * FROM clubs WHERE name = :name LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':name' => $name]);
        return $stmt->fetch();
    }

    public function getLicenciesCount($clubId) {
        $sql = "SELECT COUNT(*) as count FROM licencies WHERE club_id = :club_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':club_id' => $clubId]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    public function create(array $data) {
        $sql = "INSERT INTO clubs (name, address, city, phone, email) VALUES (:name, :address, :city, :phone, :email)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'] ?? '',
            ':address' => $data['address'] ?? '',
            ':city' => $data['city'] ?? '',
            ':phone' => $data['phone'] ?? '',
            ':email' => $data['email'] ?? ''
        ]);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE clubs SET name = :name, address = :address, city = :city, phone = :phone, email = :email WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':address' => $data['address'],
            ':city' => $data['city'],
            ':phone' => $data['phone'],
            ':email' => $data['email']
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM clubs WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getTotalCount() {
        $sql = "SELECT COUNT(*) as count FROM clubs";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['count'];
    }
}
