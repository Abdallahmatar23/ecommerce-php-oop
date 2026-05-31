<?php

namespace App\Classes\Models;

use App\Classes\Core\Database;




class User
{
    // private int $id;
    // private string $name;
    // private string $email;
    // private float $role;
    // private string $craete_at;
    // private int $update_at;

    private Database $db;


    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
    }



    public function add_user(
        string $name,
        string $email,
        string $phone,
        string $password,
        string $role
    ) {
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO `users` (`name`,`email`,`phone`,`password`,`role`) VALUES (?,?,?,?,?)';
        $params = [$name, $email, $phone, $passwordhash, $role];
        $stmt = $this->db->query($sql, $params);

        if ($stmt) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users ORDER BY FIELD (`role`,'superadmin','admin','user')";
        $params = [];

        return $this->db->fetchAll($sql, $params);
    }

    public function getById( $id)
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $params = [$id];
        return $this->db->fetch($sql, $params);
    }

    public function update()
    {

    }
    public function deleteoneuser($id)
    {
        $sql = 'DELETE FROM `users` WHERE id=?';
        $params = [$id];
        $this->db->query($sql, $params);
        return true;
    }
    public function updateoneuser($id,$name,$email,$role,$phone,$update_at)
    {
        $sql = 'UPDATE 
                    `users` 
                    SET
                        `name`=?
                        ,`email`=?
                        ,`role`=?
                        ,`phone`=?
                        ,`updated_at`=?
                    WHERE 
                        `id`=?';
        $params = [$name,$email,$role,$phone,$update_at,$id];
        $this->db->query($sql, $params);
        return true;
    }
}
