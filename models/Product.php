<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';

class Product
{
    public static function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $st = getPDO()->prepare('SELECT * FROM products ORDER BY created_at DESC LIMIT ? OFFSET ?');
        $st->bindValue(1, $perPage, PDO::PARAM_INT);
        $st->bindValue(2, $offset, PDO::PARAM_INT);
        $st->execute();
        $total = (int) getPDO()->query('SELECT COUNT(*) FROM products')->fetchColumn();
        return [
            'items' => $st->fetchAll(),
            'total' => $total,
            'totalPages' => max(1, (int) ceil($total / $perPage)),
            'currentPage' => $page,
        ];
    }

    public static function findById(int $id): array|false
    {
        $st = getPDO()->prepare('SELECT * FROM products WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function create(string $name, string $desc, float $price, string $img): bool
    {
        $st = getPDO()->prepare('INSERT INTO products (name, description, price, img) VALUES (?,?,?,?)');
        return $st->execute([$name, $desc, $price, $img]);
    }

    public static function update(int $id, string $name, string $desc, float $price, string $img): bool
    {
        $st = getPDO()->prepare('UPDATE products SET name=?, description=?, price=?, img=? WHERE id=?');
        return $st->execute([$name, $desc, $price, $img, $id]);
    }

    public static function delete(int $id): bool
    {
        $st = getPDO()->prepare('DELETE FROM products WHERE id = ?');
        return $st->execute([$id]);
    }

    public static function all(): array
    {
        return getPDO()->query('SELECT * FROM products')->fetchAll();
    }
}
