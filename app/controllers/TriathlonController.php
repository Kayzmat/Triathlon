<?php
require_once __DIR__ . '/../models/Triathlon.php';

class TriathlonController {
    private $triathlonModel;

    public function __construct() {
        $this->triathlonModel = new Triathlon();
    }

    public function index() {
        $triathlons = $this->triathlonModel->getAll();

        // Ajouter le nombre de participants pour chaque triathlon
        foreach ($triathlons as &$triathlon) {
            $triathlon['participants_count'] = $this->triathlonModel->getParticipantsCount($triathlon['id']);
        }

        return ['triathlons' => $triathlons];
    }

    public function show($id) {
        $triathlon = $this->triathlonModel->getById($id);
        if (!$triathlon) {
            return ['error' => 'Triathlon non trouvé'];
        }

        $triathlon['participants_count'] = $this->triathlonModel->getParticipantsCount($id);
        return ['triathlon' => $triathlon];
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'type' => $_POST['type'] ?? '',
                'location' => $_POST['location'] ?? '',
                'event_date' => $_POST['event_date'] ?? '',
                'description' => $_POST['description'] ?? '',
                'max_participants' => $_POST['max_participants'] ?? null,
                'registration_deadline' => $_POST['registration_deadline'] ?? null
            ];

            if ($this->triathlonModel->create($data)) {
                header('Location: index.php?module=triathlons');
                exit;
            } else {
                return ['error' => 'Erreur lors de la création du triathlon'];
            }
        }

        return [];
    }

    public function edit($id) {
        $triathlon = $this->triathlonModel->getById($id);
        if (!$triathlon) {
            return ['error' => 'Triathlon non trouvé'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'type' => $_POST['type'] ?? '',
                'location' => $_POST['location'] ?? '',
                'event_date' => $_POST['event_date'] ?? '',
                'description' => $_POST['description'] ?? '',
                'max_participants' => $_POST['max_participants'] ?? null,
                'registration_deadline' => $_POST['registration_deadline'] ?? null
            ];

            if ($this->triathlonModel->update($id, $data)) {
                header('Location: index.php?module=triathlons');
                exit;
            } else {
                return ['error' => 'Erreur lors de la modification du triathlon'];
            }
        }

        return ['triathlon' => $triathlon];
    }

    public function delete($id) {
        if ($this->triathlonModel->delete($id)) {
            header('Location: index.php?module=triathlons');
            exit;
        } else {
            return ['error' => 'Erreur lors de la suppression du triathlon'];
        }
    }
}
?>
