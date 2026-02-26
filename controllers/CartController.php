<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../models/Product.php';

class CartController
{
    public function index(): void
    {
        $items = Cart::get();
        $total = Cart::total();
        require __DIR__ . '/../templates/cart/index.php';
    }

    public function add(): void
    {
        $this->verifyCsrf();
        $id = (int) ($_POST['id'] ?? 0);
        $product = Product::findById($id);
        if ($product)
            Cart::add($id, $product['name'], (float) $product['price']);
        header('Location: index.php?action=cart');
        exit;
    }

    public function update(): void
    {
        $this->verifyCsrf();
        Cart::update((int) ($_POST['id'] ?? 0), (int) ($_POST['qty'] ?? 0));
        header('Location: index.php?action=cart');
        exit;
    }

    public function remove(): void
    {
        $this->verifyCsrf();
        Cart::remove((int) ($_POST['id'] ?? 0));
        header('Location: index.php?action=cart');
        exit;
    }

    public function clear(): void
    {
        $this->verifyCsrf();
        Cart::clear();
        header('Location: index.php?action=cart');
        exit;
    }

    private function verifyCsrf(): void
    {
        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            http_response_code(403);
            exit('CSRF invalide.');
        }
    }
}
