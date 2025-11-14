<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Club.php';
require_once __DIR__ . '/../models/Licencie.php';
require_once __DIR__ . '/../models/Triathlon.php';

class DashboardController {
    private $clubModel;
    private $licencieModel;
    private $triathlonModel;
    private $db;

    public function __construct() {
        $this->clubModel = new Club();
        $this->licencieModel = new Licencie();
        $this->triathlonModel = new Triathlon();
        $this->db = Database::getInstance()->getConnection();
    }

    public function index() {
        $user = $_SESSION['user'];

        if ($user['role'] === 'admin') {
            // Dashboard Admin
            $data = [
                'clubs_count' => $this->clubModel->getTotalCount(),
                'licencies_count' => $this->licencieModel->getTotalCount(),
                'triathlons_count' => $this->triathlonModel->getUpcomingCount(),
                'recent_clubs' => $this->getRecentClubs()
            ];
        } else {
            // Dashboard Responsable Club
            $data = [
                'licencies_count' => $this->licencieModel->getCountByClub($user['club_id']),
                'registrations_count' => $this->getRegistrationsCount($user['club_id']),
                'results_count' => $this->getResultsCount($user['club_id']),
                'my_licencies' => $this->licencieModel->getByClub($user['club_id']),
                'my_registrations' => $this->getMyRegistrations($user['club_id'])
            ];
        }

        return $data;
    }

    private function getRecentClubs() {
        $clubs = $this->clubModel->getAll();
        // Retourner les 5 derniers clubs (simulation)
        return array_slice($clubs, 0, 5);
    }

    private function getMyRegistrations($clubId) {
        // Récupération des inscriptions réelles depuis la base de données
        $sql = "SELECT t.name as triathlon_name, t.event_date, t.location, r.status
                FROM registrations r
                JOIN triathlons t ON r.triathlon_id = t.id
                JOIN licencies l ON r.licencie_id = l.id
                WHERE l.club_id = :club_id
                ORDER BY t.event_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':club_id' => $clubId]);
        $results = $stmt->fetchAll();

        // Traduction des statuts
        $statusTranslations = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'cancelled' => 'Annulé'
        ];

        foreach ($results as &$result) {
            $result['status'] = $statusTranslations[$result['status']] ?? $result['status'];
        }

        return $results;
    }

    private function getRegistrationsCount($clubId) {
        $sql = "SELECT COUNT(*) as count
                FROM registrations r
                JOIN licencies l ON r.licencie_id = l.id
                WHERE l.club_id = :club_id AND r.status IN ('pending', 'confirmed')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':club_id' => $clubId]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    private function getResultsCount($clubId) {
        // Simulation - à implémenter avec une table results
        // Pour l'instant, on retourne un nombre fixe basé sur les données de test
        return 12; // À remplacer par une vraie requête quand la table results sera créée
    }
}
?>
