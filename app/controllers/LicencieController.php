<?php
require_once __DIR__ . '/../models/Licencie.php';
require_once __DIR__ . '/../models/Club.php';

class LicencieController {
    private $licencieModel;
    private $clubModel;

    public function __construct() {
        $this->licencieModel = new Licencie();
        $this->clubModel = new Club();
    }

    public function index() {
        $filters = [];

        if (isset($_GET['club_id']) && !empty($_GET['club_id'])) {
            $filters['club_id'] = $_GET['club_id'];
        }

        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $filters['category'] = $_GET['category'];
        }

        if (isset($_GET['license_type']) && !empty($_GET['license_type'])) {
            $filters['license_type'] = $_GET['license_type'];
        }

        $licencies = $this->licencieModel->getAll($filters);
        $clubs = $this->clubModel->getAll();

        return [
            'licencies' => $licencies,
            'clubs' => $clubs,
            'filters' => $filters
        ];
    }

    public function show($id) {
        $licencie = $this->licencieModel->getById($id);
        if (!$licencie) {
            return ['error' => 'Licencié non trouvé'];
        }

        return ['licencie' => $licencie];
    }

    public function create() {
        $clubs = $this->clubModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'license_number' => $_POST['license_number'] ?? '',
                'first_name' => $_POST['first_name'] ?? '',
                'last_name' => $_POST['last_name'] ?? '',
                'birth_date' => $_POST['birth_date'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'category' => $_POST['category'] ?? '',
                'license_type' => $_POST['license_type'] ?? '',
                'club_id' => $_POST['club_id'] ?? null,
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? ''
            ];

            if ($this->licencieModel->create($data)) {
                header('Location: index.php?module=licencies');
                exit;
            } else {
                return ['error' => 'Erreur lors de la création du licencié', 'clubs' => $clubs];
            }
        }

        return ['clubs' => $clubs];
    }

    public function edit($id) {
        $licencie = $this->licencieModel->getById($id);
        $clubs = $this->clubModel->getAll();

        if (!$licencie) {
            return ['error' => 'Licencié non trouvé'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'license_number' => $_POST['license_number'] ?? '',
                'first_name' => $_POST['first_name'] ?? '',
                'last_name' => $_POST['last_name'] ?? '',
                'birth_date' => $_POST['birth_date'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'category' => $_POST['category'] ?? '',
                'license_type' => $_POST['license_type'] ?? '',
                'club_id' => $_POST['club_id'] ?? null,
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? ''
            ];

            if ($this->licencieModel->update($id, $data)) {
                header('Location: index.php?module=licencies');
                exit;
            } else {
                return ['error' => 'Erreur lors de la modification du licencié', 'licencie' => $licencie, 'clubs' => $clubs];
            }
        }

        return ['licencie' => $licencie, 'clubs' => $clubs];
    }

    public function delete($id) {
        if ($this->licencieModel->delete($id)) {
            header('Location: index.php?module=licencies');
            exit;
        } else {
            return ['error' => 'Erreur lors de la suppression du licencié'];
        }
    }
}
?>
