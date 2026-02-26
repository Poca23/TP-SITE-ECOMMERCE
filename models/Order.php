<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';

class Order
{
    public static function create(int $userId, float $total, array $items): int
    {
        $pdo = getPDO();
        $st = $pdo->prepare('INSERT INTO orders (user_id, total, status) VALUES (?,?,?)');
        $st->execute([$userId, $total, 'paid']);
        $orderId = (int) $pdo->lastInsertId();

        $si = $pdo->prepare('INSERT INTO order_items (order_id, product_id, qty, unit_price) VALUES (?,?,?,?)');
        foreach ($items as $item) {
            $si->execute([$orderId, $item['id'], $item['qty'], $item['price']]);
        }
        return $orderId;
    }

    public static function findByUser(int $userId): array
    {
        $st = getPDO()->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC');
        $st->execute([$userId]);
        return $st->fetchAll();
    }

    public static function findById(int $id): array|false
    {
        $st = getPDO()->prepare('SELECT * FROM orders WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch();
    }
}
