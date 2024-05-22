<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    private $pdo;

    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['db']}";
        $this->pdo = new PDO($dsn, $config['user'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($rows as $row) {
            $users[] = new User($row['id'], $row['first_name'], $row['last_name'], $row['email']);
        }
        return $users;
    }

    public function createUser($first_name, $last_name, $email)
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (first_name, last_name, email) VALUES (?, ?, ?)');
        $stmt->execute([$first_name, $last_name, $email]);
        $id = $this->pdo->lastInsertId();
        return new User($id, $first_name, $last_name, $email);
    }
}
