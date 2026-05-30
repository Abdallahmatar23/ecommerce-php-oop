<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Model;

class User extends Model
{
    private ?int $id;
    private string $name;
    private string $email;
    private string $role;
    private string $create_at;
    private string $update_at;



    public function __construct(?int $id = null, string $name = "", string $email = "", string $role = "", string $create_at = "", string $update_at = "")
    {
         parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->create_at = $create_at;
        $this->update_at = $update_at;
    }



    public function add_user(
        string $name,
        string $email,
        string $password,
        string $role
    ) {
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO `users` (`name`,`email`,`password`,`role`) VALUES (?,?,?,?)';
        $params = [$name, $email, $passwordhash, $role];

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

    public function update() {}
    public function delete() {}
}
