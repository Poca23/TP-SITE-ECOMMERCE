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
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $user = User::findById((int) $_SESSION['user_id']);
        $orders = Order::findByUser((int) $_SESSION['user_id']);
        $error = '';
        $success = '';

        if ($username === '' || $email === '') {
            $error = 'Nom d\'utilisateur et email requis.';
        } elseif ($newPassword !== '' || $currentPassword !== '') {
            // Changement de mot de passe demandé
            if (!password_verify($currentPassword, $user['password'])) {
                $error = 'Mot de passe actuel incorrect.';
            } elseif (strlen($newPassword) < 8) {
                $error = 'Nouveau mot de passe trop court (min. 8 caractères).';
            } elseif ($newPassword !== $confirmPassword) {
                $error = 'Les nouveaux mots de passe ne correspondent pas.';
            } else {
                User::update((int) $_SESSION['user_id'], $username, $email);
                User::updatePassword((int) $_SESSION['user_id'], $newPassword);
                $_SESSION['username'] = $username;
                $success = 'Profil et mot de passe mis à jour.';
                $user['username'] = $username;
                $user['email'] = $email;
            }
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
            header('Location: index.php?action=login');
            exit;
        }
    }
}
