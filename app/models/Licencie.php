<?php
require_once __DIR__ . '/../core/Database.php';

class Licencie {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($filters = []) {
        $sql = "SELECT l.*, c.name as club_name FROM licencies l LEFT JOIN clubs c ON l.club_id = c.id";
        $params = [];
        $where = [];

        if (!empty($filters['club_id'])) {
            $where[] = "l.club_id = :club_id";
            $params[':club_id'] = $filters['club_id'];
        }

        if (!empty($filters['q'])) {
            $where[] = "(l.first_name LIKE :q OR l.last_name LIKE :q OR l.email LIKE :q)";
            $params[':q'] = '%' . $filters['q'] . '%';
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

    public function create(array $data) {
        $sql = "INSERT INTO licencies (license_number, first_name, last_name, birth_date, gender, category, license_type, club_id, email, phone)
            VALUES (:license_number, :first_name, :last_name, :birth_date, :gender, :category, :license_type, :club_id, :email, :phone)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':license_number' => $data['license_number'] ?? $data['licence_number'] ?? null,
            ':first_name' => $data['first_name'] ?? null,
            ':last_name'  => $data['last_name'] ?? null,
            ':birth_date' => $data['birth_date'] ?? $data['birthdate'] ?? null,
            ':gender' => $data['gender'] ?? 'M',
            ':category' => $data['category'] ?? 'Senior',
            ':license_type' => $data['license_type'] ?? $data['licence_type'] ?? 'Loisir',
            ':club_id'    => isset($data['club_id']) && $data['club_id'] !== '' ? $data['club_id'] : null,
            ':email' => $data['email'] ?? null,
            ':phone' => $data['phone'] ?? null,
        ]);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE licencies SET license_number = :license_number, first_name = :first_name, last_name = :last_name, birth_date = :birth_date, gender = :gender, category = :category, license_type = :license_type, club_id = :club_id, email = :email, phone = :phone WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':license_number' => $data['license_number'] ?? $data['licence_number'] ?? null,
            ':first_name' => $data['first_name'] ?? null,
            ':last_name' => $data['last_name'] ?? null,
            ':birth_date' => $data['birth_date'] ?? $data['birthdate'] ?? null,
            ':gender' => $data['gender'] ?? 'M',
            ':category' => $data['category'] ?? 'Senior',
            ':license_type' => $data['license_type'] ?? $data['licence_type'] ?? 'Loisir',
            ':club_id' => isset($data['club_id']) && $data['club_id'] !== '' ? $data['club_id'] : null,
            ':email' => $data['email'] ?? null,
            ':phone' => $data['phone'] ?? null,
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
        return (int)($result['count'] ?? 0);
    }

    public function getCountByClub($clubId) {
        $sql = "SELECT COUNT(*) as count FROM licencies WHERE club_id = :club_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':club_id' => $clubId]);
        $result = $stmt->fetch();
        return (int)($result['count'] ?? 0);
    }
}
?>
