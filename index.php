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

    try {
        switch ($module) {
            case 'dashboard':
                $controller = new DashboardController();
                $data = $controller->index();
                break;

            case 'clubs':
                $controller = new ClubController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                } elseif ($action === 'create') {
                    $data = $controller->create();
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                }
                break;

            case 'licencies':
                $controller = new LicencieController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                } elseif ($action === 'create') {
                    $data = $controller->create();
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                }
                break;

            case 'triathlons':
                $controller = new TriathlonController();
                if ($action === 'show' && $id) {
                    $data = $controller->show($id);
                } elseif ($action === 'create') {
                    $data = $controller->create();
                } elseif ($action === 'edit' && $id) {
                    $data = $controller->edit($id);
                } elseif ($action === 'delete' && $id) {
                    $controller->delete($id);
                    exit;
                } else {
                    $data = $controller->index();
                }
                break;

            default:
                throw new Exception("Module non trouvé");
        }

        // Inclure la vue
        $viewFile = "app/views/$module/index.php";
        if (file_exists($viewFile)) {
            $content = $viewFile;
            include 'app/views/layouts/main.php';
        } else {
            echo "Vue non trouvée : $viewFile";
        }

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
