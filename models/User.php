<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/database.php';

class User
{
    public static function findByEmail(string $email): array|false
    {
        $st = getPDO()->prepare('SELECT * FROM users WHERE email = ?');
        $st->execute([$email]);
        return $st->fetch();
    }

    public static function create(string $username, string $email, string $password): bool
    {
        $st = getPDO()->prepare(
            'INSERT INTO users (username, email, password) VALUES (?, ?, ?)'
        );
        return $st->execute([$username, $email, password_hash($password, PASSWORD_BCRYPT, ['cost' => 12])]);
    }

    public static function emailExists(string $email): bool
    {
        $st = getPDO()->prepare('SELECT id FROM users WHERE email = ?');
        $st->execute([$email]);
        return (bool) $st->fetch();
    }

    public static function usernameExists(string $username): bool
    {
        $st = getPDO()->prepare('SELECT id FROM users WHERE username = ?');
        $st->execute([$username]);
        return (bool) $st->fetch();
    }

    public static function findById(int $id): array|false
    {
        $st = getPDO()->prepare('SELECT * FROM users WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch();
    }

    public static function update(int $id, string $username, string $email): bool
    {
        $st = getPDO()->prepare('UPDATE users SET username=?, email=? WHERE id=?');
        return $st->execute([$username, $email, $id]);
    }
}
