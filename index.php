<?php
declare(strict_types=1);

// Chargement des variables d'environnement
if (file_exists(__DIR__ . '/.env')) {
    foreach (file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#'))
            continue;
        [$key, $value] = explode('=', $line, 2);
        putenv(trim($key) . '=' . trim($value));
    }
}

session_start();

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CartController.php';
require_once __DIR__ . '/controllers/OrderController.php';
require_once __DIR__ . '/controllers/ProfileController.php';

$action = $_GET['action'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];

$auth = new AuthController();
$product = new ProductController();
$cart = new CartController();
$order = new OrderController();
$profile = new ProfileController();
$home = new HomeController();

match (true) {
    $action === 'login' && $method === 'GET' => $auth->loginForm(),
    $action === 'login' && $method === 'POST' => $auth->login(),
    $action === 'register' && $method === 'GET' => $auth->registerForm(),
    $action === 'register' && $method === 'POST' => $auth->register(),
    $action === 'logout' => $auth->logout(),
    $action === 'products' => $product->index(),
    $action === 'product.create' && $method === 'GET' => $product->createForm(),
    $action === 'product.create' && $method === 'POST' => $product->create(),
    $action === 'product.edit' && $method === 'GET' => $product->editForm(),
    $action === 'product.edit' && $method === 'POST' => $product->edit(),
    $action === 'product.delete' && $method === 'POST' => $product->delete(),
    $action === 'cart' && $method === 'GET' => $cart->index(),
    $action === 'cart.add' && $method === 'POST' => $cart->add(),
    $action === 'cart.update' && $method === 'POST' => $cart->update(),
    $action === 'cart.remove' && $method === 'POST' => $cart->remove(),
    $action === 'cart.clear' && $method === 'POST' => $cart->clear(),
    $action === 'checkout' && $method === 'GET' => $order->checkoutForm(),
    $action === 'checkout' && $method === 'POST' => $order->checkout(),
    $action === 'confirm' => $order->confirm(),
    $action === 'profile' && $method === 'GET' => $profile->index(),
    $action === 'profile' && $method === 'POST' => $profile->update(),
    default => $home->index(),
};
