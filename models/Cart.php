<?php
declare(strict_types=1);

class Cart
{
    public static function get(): array
    {
        return $_SESSION['cart'] ?? [];
    }

    public static function add(int $id, string $name, float $price): void
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty']++;
        } else {
            $_SESSION['cart'][$id] = ['id' => $id, 'name' => $name, 'price' => $price, 'qty' => 1];
        }
    }

    public static function update(int $id, int $qty): void
    {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
    }

    public static function remove(int $id): void
    {
        unset($_SESSION['cart'][$id]);
    }

    public static function clear(): void
    {
        $_SESSION['cart'] = [];
    }

    public static function total(): float
    {
        return array_reduce(
            self::get(),
            fn($carry, $item) => $carry + $item['price'] * $item['qty'],
            0.0
        );
    }

    public static function count(): int
    {
        return array_reduce(
            self::get(),
            fn($carry, $item) => $carry + $item['qty'],
            0
        );
    }
}
