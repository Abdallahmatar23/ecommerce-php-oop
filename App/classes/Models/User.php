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
        string $password,
        string $role
    ) {
        $passwordhash=password_hash($password,PASSWORD_DEFAULT);
        $sql ='INSERT INTO `users` (`name`,`email`,`password`,`role`) VALUES (?,?,?,?)';
        $params = [$name, $email, $passwordhash, $role];
        $stmt = $this->db->query($sql,$params);

        if($stmt){
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getAll(){
        $sql = 'SELECT * FROM users';
        $params = [];

        return $this->db->fetchAll($sql,$params);
    }

    public function getById(int $id){
        $sql = 'SELECT * FROM users WHERE id = ?';
        $params = [$id];
        return $this->db->fetch($sql,$params);
    }

    public function update(){}
    public function delete(){}
}
