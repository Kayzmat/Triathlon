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
        // charger le modèle Club pour récupérer la liste des clubs
        require_once 'app/models/Club.php';
        $clubModel = new Club();
        $clubs = $clubModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les champs
            $license_number = trim($_POST['license_number'] ?? '');
            $first = trim($_POST['first_name'] ?? '');
            $last  = trim($_POST['last_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $birth = trim($_POST['birth_date'] ?? $_POST['birthdate'] ?? '');
            $gender = $_POST['gender'] ?? 'M';
            $category = $_POST['category'] ?? 'Senior';
            $license_type = $_POST['license_type'] ?? 'Loisir';
            $phone = trim($_POST['phone'] ?? '');
            $club_id_post = $_POST['club_id'] ?? '';
            $club_name_new = trim($_POST['club_name_new'] ?? '');

            $errors = [];

            // validations minimales
            if ($license_number === '') $errors[] = 'Numéro de licence requis';
            if ($first === '') $errors[] = 'Prénom requis';
            if ($last === '') $errors[] = 'Nom requis';
            if ($club_id_post === '' && $club_name_new === '') $errors[] = 'Club requis (sélectionnez ou saisissez un nouveau club)';
            if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email invalide';

            // si erreurs -> renvoyer vers la vue avec old values et liste des clubs
            if (!empty($errors)) {
                return ['errors' => $errors, 'old' => $_POST, 'clubs' => $clubs];
            }

            // déterminer club_id : si sélection numérique -> utiliser, sinon créer nouveau club si club_name_new fourni
            $clubId = null;
            if (is_numeric($club_id_post) && (int)$club_id_post > 0) {
                $clubId = (int)$club_id_post;
            } else {
                // chercher par nom si fourni, sinon créer
                if ($club_name_new !== '') {
                    $existing = $clubModel->getByName($club_name_new);
                    if ($existing) {
                        $clubId = $existing['id'];
                    } else {
                        $clubId = $clubModel->create([
                            'name' => $club_name_new,
                            'address' => '',
                            'city' => '',
                            'phone' => '',
                            'email' => ''
                        ]);
                    }
                }
            }

            // sécurité : s'assurer qu'on a bien un club_id final
            if (!$clubId) {
                $errors[] = 'Impossible de déterminer le club (erreur interne)';
                return ['errors' => $errors, 'old' => $_POST, 'clubs' => $clubs];
            }

            // créer le licencié
            require_once 'app/models/Licencie.php';
            $licModel = new Licencie();
            $newId = $licModel->create([
                'license_number' => $license_number,
                'first_name' => $first,
                'last_name' => $last,
                'birth_date' => $birth,
                'gender' => $gender,
                'category' => $category,
                'license_type' => $license_type,
                'club_id' => $clubId,
                'email' => $email,
                'phone' => $phone,
            ]);

            $_SESSION['flash'] = "Licencié ajouté (ID: $newId)";
            header('Location: index.php?module=licencies');
            exit;
        }

        // GET => afficher formulaire avec la liste des clubs
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
