<?php
require_once __DIR__ . '/../config/database.php';

class User {

    public static function findByEmail(string $email): array|false {
        $st = getPDO()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $st->execute([$email]);
        return $st->fetch();
    }

    public static function findByUsername(string $username): array|false {
        $st = getPDO()->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $st->execute([$username]);
        return $st->fetch();
    }

    public static function create(string $username, string $email, string $password): bool {
        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $st   = getPDO()->prepare(
            'INSERT INTO users (username, email, password) VALUES (?, ?, ?)'
        );
        return $st->execute([$username, $email, $hash]);
    }

    public static function verify(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}
