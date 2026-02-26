<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function login(): void {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
                http_response_code(403);
                exit('Token CSRF invalide.');
            }

            $email    = trim($_POST['email']    ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = 'Tous les champs sont requis.';
            } else {
                $user = User::findByEmail($email);
                if ($user && User::verify($password, $user['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role']     = $user['role'];
                    header('Location: index.php');
                    exit;
                }
                $error = 'Identifiants incorrects.';
            }
        }

        require __DIR__ . '/../templates/auth/login.php';
    }

    public function register(): void {
        $error   = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
                http_response_code(403);
                exit('Token CSRF invalide.');
            }

            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email']    ?? '');
            $password = $_POST['password']      ?? '';
            $confirm  = $_POST['confirm']       ?? '';

            if ($username === '' || $email === '' || $password === '') {
                $error = 'Tous les champs sont requis.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email invalide.';
            } elseif (strlen($password) < 8) {
                $error = 'Le mot de passe doit contenir au moins 8 caractères.';
            } elseif ($password !== $confirm) {
                $error = 'Les mots de passe ne correspondent pas.';
            } elseif (User::findByEmail($email)) {
                $error = 'Cet email est déjà utilisé.';
            } elseif (User::findByUsername($username)) {
                $error = "Ce nom d'utilisateur est déjà pris.";
            } else {
                User::create($username, $email, $password);
                $success = 'Compte créé ! <a href="index.php?action=login">Se connecter</a>';
            }
        }

        require __DIR__ . '/../templates/auth/register.php';
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
