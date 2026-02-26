<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function loginForm(): void
    {
        $error = '';
        require __DIR__ . '/../templates/auth/login.php';
    }

    public function login(): void
    {
        $error = '';
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            $error = 'Token invalide.';
        } elseif ($email === '' || $password === '') {
            $error = 'Tous les champs sont requis.';
        } else {
            $user = User::findByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php');
                exit;
            }
            $error = 'Identifiants incorrects.';
        }
        require __DIR__ . '/../templates/auth/login.php';
    }

    public function registerForm(): void
    {
        $error = '';
        require __DIR__ . '/../templates/auth/register.php';
    }

    public function register(): void
    {
        $error = '';
        $username = trim(strip_tags($_POST['username'] ?? ''));
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm'] ?? '';

        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            $error = 'Token invalide.';
        } elseif ($username === '' || $email === '' || $password === '') {
            $error = 'Tous les champs sont requis.';
        } elseif (strlen($password) < 8) {
            $error = 'Mot de passe trop court (min. 8 caractères).';
        } elseif ($password !== $confirm) {
            $error = 'Les mots de passe ne correspondent pas.';
        } elseif (User::emailExists($email)) {
            $error = 'Cet email est déjà utilisé.';
        } elseif (User::usernameExists($username)) {
            $error = 'Ce nom d\'utilisateur est pris.';
        } else {
            User::create($username, $email, $password);
            header('Location: index.php?action=login');
            exit;
        }
        require __DIR__ . '/../templates/auth/register.php';
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
