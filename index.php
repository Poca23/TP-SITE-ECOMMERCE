<?php
declare(strict_types=1);
session_start();

// Génération du token CSRF
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/AuthController.php';

$action = $_GET['action'] ?? 'home';

$productCtrl = new ProductController();
$authCtrl    = new AuthController();

match ($action) {
    'login'    => $authCtrl->login(),
    'register' => $authCtrl->register(),
    'logout'   => $authCtrl->logout(),
    'create'   => $productCtrl->create(),
    'edit'     => $productCtrl->edit(),
    'delete'   => $productCtrl->delete(),
    default    => $productCtrl->index(),
};
