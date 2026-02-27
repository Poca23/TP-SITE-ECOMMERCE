<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Cart.php';

class OrderController
{
    public function checkoutForm(): void
    {
        $this->requireAuth();
        $items = Cart::get();
        $total = Cart::total();
        if (empty($items)) {
            header('Location: index.php?action=cart');
            exit;
        }
        $error = '';
        require __DIR__ . '/../templates/order/checkout.php';
    }

    public function checkout(): void
    {
        $this->requireAuth();
        $this->verifyCsrf();
        $items = Cart::get();
        $total = Cart::total();
        if (empty($items)) {
            header('Location: index.php?action=cart');
            exit;
        }
        $card = trim($_POST['card'] ?? '');
        $exp = trim($_POST['exp'] ?? '');
        $cvv = trim($_POST['cvv'] ?? '');
        $error = '';
        if (strlen(preg_replace('/\s+/', '', $card)) < 16 || $exp === '' || strlen($cvv) < 3) {
            $error = 'Informations de paiement invalides.';
            require __DIR__ . '/../templates/order/checkout.php';
            return;
        }
        $orderId = Order::create((int) $_SESSION['user_id'], $total, array_values($items));
        Cart::clear();
        $_SESSION['last_order_id'] = $orderId;
        header('Location: index.php?action=confirm');
        exit;
    }

    public function confirm(): void
    {
        $this->requireAuth();
        $orderId = $_SESSION['last_order_id'] ?? 0;
        $order = Order::findById((int) $orderId);
        require __DIR__ . '/../templates/order/confirm.php';
    }

    private function requireAuth(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?action=login&reason=expired');
            exit;
        }
    }

    private function verifyCsrf(): void
    {
        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            http_response_code(403);
            exit('CSRF invalide.');
        }
    }
}
