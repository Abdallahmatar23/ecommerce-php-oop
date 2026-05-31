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
    private string $createdAt;
    private string $updatedAt;



    public function __construct(?int $id = null, string $name = "", string $email = "", string $role = "", string $createdAt = "", string $updatedAt = "")
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }



    public function getName()
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function setRole(string $role)
    {
        $this->role = $role;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


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
}
