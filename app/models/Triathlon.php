<?php
require_once __DIR__ . '/../core/Database.php';

class Triathlon {
    protected $db;

    public function __construct() {
        // Remplacement de l'appel invalide PDO::getConnection() par le singleton Database
        $this->db = Database::getInstance();
        $this->ensureTable();
    }

    protected function ensureTable() {
        // création minimale de la table triathlons pour éviter les erreurs si elle n'existe pas
        $sql = "CREATE TABLE IF NOT EXISTS triathlons (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(150) NOT NULL,
            event_date DATE DEFAULT NULL,
            location VARCHAR(150) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $this->db->exec($sql);
    }

    public function getAll() {
        $sql = "SELECT * FROM triathlons ORDER BY event_date DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM triathlons WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function getUpcoming() {
        $sql = "SELECT * FROM triathlons WHERE event_date >= CURDATE() ORDER BY event_date ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO triathlons (name, type, location, event_date, description, max_participants, registration_deadline) VALUES (:name, :type, :location, :event_date, :description, :max_participants, :registration_deadline)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':type' => $data['type'],
            ':location' => $data['location'],
            ':event_date' => $data['event_date'],
            ':description' => $data['description'] ?? null,
            ':max_participants' => $data['max_participants'] ?? null,
            ':registration_deadline' => $data['registration_deadline'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE triathlons SET name = :name, type = :type, location = :location, event_date = :event_date, description = :description, max_participants = :max_participants, registration_deadline = :registration_deadline WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':type' => $data['type'],
            ':location' => $data['location'],
            ':event_date' => $data['event_date'],
            ':description' => $data['description'] ?? null,
            ':max_participants' => $data['max_participants'] ?? null,
            ':registration_deadline' => $data['registration_deadline'] ?? null
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM triathlons WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function getParticipantsCount($triathlonId) {
        $sql = "SELECT COUNT(*) as count FROM registrations WHERE triathlon_id = :triathlon_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':triathlon_id' => $triathlonId]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    public function getTotalCount() {
        $sql = "SELECT COUNT(*) as count FROM triathlons";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['count'];
    }

    public function getUpcomingCount() {
        $sql = "SELECT COUNT(*) as count FROM triathlons WHERE event_date >= CURDATE()";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['count'];
    }
}
