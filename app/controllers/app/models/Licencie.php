<?php
require_once __DIR__ . '/../core/Database.php';

class Licencie {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($filters = []) {
        $sql = "SELECT l.*, c.name as club_name FROM licencies l LEFT JOIN clubs c ON l.club_id = c.id";
        $params = [];
        $where = [];

        if (!empty($filters['club_id'])) {
            $where[] = "l.club_id = :club_id";
            $params[':club_id'] = $filters['club_id'];
        }

        if (!empty($filters['category'])) {
            $where[] = "l.category = :category";
            $params[':category'] = $filters['category'];
        }

        if (!empty($filters['license_type'])) {
            $where[] = "l.license_type = :license_type";
            $params[':license_type'] = $filters['license_type'];
        }

        if (!empty($where)) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY l.last_name, l.first_name";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT l.*, c.name as club_name FROM licencies l LEFT JOIN clubs c ON l.club_id = c.id WHERE l.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getByClub($clubId) {
        $sql = "SELECT * FROM licencies WHERE club_id = :club_id ORDER BY last_name, first_name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':club_id' => $clubId]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO licencies (license_number, first_name, last_name, birth_date, gender, category, license_type, club_id, email, phone) VALUES (:license_number, :first_name, :last_name, :birth_date, :gender, :category, :license_type, :club_id, :email, :phone)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':license_number' => $data['license_number'],
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':birth_date' => $data['birth_date'],
            ':gender' => $data['gender'],
            ':category' => $data['category'],
            ':license_type' => $data['license_type'],
            ':club_id' => $data['club_id'],
            ':email' => $data['email'] ?? null,
            ':phone' => $data['phone'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE licencies SET license_number = :license_number, first_name = :first_name, last_name = :last_name, birth_date = :birth_date, gender = :gender, category = :category, license_type = :license_type, club_id = :club_id, email = :email, phone = :phone WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':license_number' => $data['license_number'],
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':birth_date' => $data['birth_date'],
            ':gender' => $data['gender'],
            ':category' => $data['category'],
            ':license_type' => $data['license_type'],
            ':club_id' => $data['club_id'],
            ':email' => $data['email'] ?? null,
            ':phone' => $data['phone'] ?? null
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM licencies WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getTotalCount() {
        $sql = "SELECT COUNT(*) as count FROM licencies";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['count'];
    }

    public function getCountByClub($clubId) {
        $sql = "SELECT COUNT(*) as count FROM licencies WHERE club_id = :club_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':club_id' => $clubId]);
        $result = $stmt->fetch();
        return $result['count'];
    }
}
?>
