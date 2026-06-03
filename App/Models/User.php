<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Model;
use PDOException;

class User extends Model
{
    private ?int $id;
    private string $name;
    private string $email;
    private string $role;
    private string $created_at;
    private string $updated_at;



    public function __construct(?int $id = null, string $name = "", string $email = "", string $role = "", string $created_at = "", string $updated_at = "")
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getCreateAt()
    {
        return $this->create_at;
    }
    public function getUpdateAt()
    {
        return $this->update_at;
    }
    public function add_user(
        string $name,
        string $email,
        string $password,
        string $role
    ) {
        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(name,email,password,role)
                VALUES(?,?,?,?)";

            $params = [$name, $email, $passwordHash, $role];

            $stmt = $this->query($sql, $params);
            if ($stmt) {
                $user = $this->getById($this->lastInsertId());
                return $user;
            }
        } catch (PDOException $e) {
            return false;
        }
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
        $user = $this->fetch($sql, $params);
        
        if ($user) {
            return new User($user['id'], $user['name'], $user['email'], $user['role'], $user['created_at'], $user['updated_at']);
        }
    }

    public function update() {}
    public function delete() {}
}
