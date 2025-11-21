<?php
session_start();

// Configuration de base
define('ROOT_PATH', __DIR__);

// Autoloader simple
spl_autoload_register(function ($className) {
    $paths = [
        'app/controllers/',
        'app/models/',
        'app/core/'
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Routage
$action = $_GET['action'] ?? 'index';
$module = $_GET['module'] ?? 'dashboard';
$id = $_GET['id'] ?? null;

// Gestion des routes
if ($action === 'login' || $action === 'authenticate') {
    $authController = new AuthController();
    $authController->login();
} elseif ($action === 'logout') {
    $authController = new AuthController();
    $authController->logout();
} else {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=login');
        exit;
    }

    // Router vers les contrôleurs
    $data = [];
    $currentPage = $module;
    $viewFile = null; // Ajouté pour éviter le warning

    try {
        switch ($module) {
            case 'dashboard':
                $controller = new DashboardController();
                $data = $controller->index();
                $viewFile = "app/views/dashboard/index.php";
                break;

            case 'clubs':
                $controller = new ClubController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                    $viewFile = "app/views/clubs/show.php";
                } elseif ($action === 'create') {
                    $data = $controller->create();
                    $viewFile = "app/views/clubs/create.php";
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                    $viewFile = "app/views/clubs/edit.php";
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                    $viewFile = "app/views/clubs/index.php";
                }
                break;

            case 'licencies':
                $controller = new LicencieController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                    $viewFile = "app/views/licencies/show.php";
                } elseif ($action === 'create') {
                    $data = $controller->create();
                    $viewFile = "app/views/licencies/create.php";
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                    $viewFile = "app/views/licencies/edit.php";
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                    $viewFile = "app/views/licencies/index.php";
                }
                break;

            case 'triathlons':
                $controller = new TriathlonController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                    $viewFile = "app/views/triathlons/show.php";
                } elseif ($action === 'create') {
                    $data = $controller->create();
                    $viewFile = "app/views/triathlons/create.php";
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                    $viewFile = "app/views/triathlons/edit.php";
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                    $viewFile = "app/views/triathlons/index.php";
                }
                break;

            case 'resultats':
                $controller = new ResultatController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                    $viewFile = "app/views/resultats/show.php";
                } elseif ($action === 'create') {
                    $data = $controller->create();
                    $viewFile = "app/views/resultats/create.php";
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                    $viewFile = "app/views/resultats/edit.php";
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                    $viewFile = "app/views/resultats/index.php";
                }
                break;

            case 'parametres':
                $controller = new ParametreController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                    $viewFile = "app/views/parametres/show.php";
                } elseif ($action === 'create') {
                    $data = $controller->create();
                    $viewFile = "app/views/parametres/create.php";
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                    $viewFile = "app/views/parametres/edit.php";
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                    $viewFile = "app/views/parametres/index.php";
                }
                break;

            default:
                throw new Exception("Module non trouvé");
        }

        // Inclure la vue
        if (isset($viewFile) && $viewFile && file_exists($viewFile)) {
            $content = $viewFile;
            include 'app/views/layouts/main.php';
        } else {
            echo "Vue non trouvée : " . ($viewFile ?? '');
        }

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
