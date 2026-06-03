<?php

namespace App\Repositories;

use App\Core\Model;



class UserRepository extends Model
{


    public function add_user(
        string $name,
        string $email,
        string $password,
        string $role
    ) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO `users` (`name`,`email`,`password`,`role`) VALUES (?,?,?,?)';
        $params = [$name, $email, $password_hash, $role];

        $stmt = $this->query($sql, $params);

        if ($stmt) {
            return $this->lastInsertId();
        }
        return false;
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM users';
        $params = [];

        return $this->fetchAll($sql, $params);
    }

    public function getById(int $id)
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $params = [$id];
        return $this->fetch($sql, $params);
    }

    public function update(int $id) {}
    public function delete(int $id) {}
}
