<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'club_id' => $user['club_id']
                ];
                header('Location: index.php?module=dashboard');
                exit;
            } else {
                $error = "Identifiants incorrects";
                include 'app/views/auth/login.php';
                exit;
            }
        } else {
            include 'app/views/auth/login.php';
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}
?>
