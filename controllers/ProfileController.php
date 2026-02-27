<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Order.php';

class ProfileController
{
    public function index(): void
    {
        $this->requireAuth();
        $user = User::findById((int) $_SESSION['user_id']);
        $orders = Order::findByUser((int) $_SESSION['user_id']);
        $error = '';
        $success = '';
        require __DIR__ . '/../templates/profile/index.php';
    }

    public function update(): void
    {
        $this->requireAuth();
        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            http_response_code(403);
            exit('CSRF invalide.');
        }
        $username = trim(strip_tags($_POST['username'] ?? ''));
        $email = trim($_POST['email'] ?? '');
        $user = User::findById((int) $_SESSION['user_id']);
        $orders = Order::findByUser((int) $_SESSION['user_id']);
        $error = '';
        $success = '';
        if ($username === '' || $email === '') {
            $error = 'Champs requis.';
        } else {
            User::update((int) $_SESSION['user_id'], $username, $email);
            $_SESSION['username'] = $username;
            $success = 'Profil mis à jour.';
            $user['username'] = $username;
            $user['email'] = $email;
        }
        require __DIR__ . '/../templates/profile/index.php';
    }

    private function requireAuth(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?action=login&reason=expired');
            exit;
        }
    }
}
