<?php
require_once __DIR__ . '/../core/Database.php';

class Club {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
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

    public function getLicenciesCount($clubId) {
        $sql = "SELECT COUNT(*) as count FROM licencies WHERE club_id = :club_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':club_id' => $clubId]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    public function create($data) {
        $sql = "INSERT INTO clubs (name, address, city, phone, email) VALUES (:name, :address, :city, :phone, :email)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':address' => $data['address'],
            ':city' => $data['city'],
            ':phone' => $data['phone'],
            ':email' => $data['email']
        ]);
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
?>
