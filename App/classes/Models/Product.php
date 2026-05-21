<?php

namespace App\Classes\Models;

use App\Classes\Core\Database;

// require_once __DIR__ . "/../Core/Database.php";  
// require_once "../Core/Database.php";
// use PDO;    



class Product
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private string $image;
    private int $stock;
    private float $discount;

    private Database $db;


    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
    }

    // public function create(
    //     string $name,
    //     string $description,
    //     float $price,
    //     string $image,
    //     int $stock,
    //     float $discount
    // ) {
    //     $stmt = $this->pdo->prepare('INSERT INTO products (name,price,description,image_url,stock,discount) VALUES (?,?,?,?,?,?)');
    //     $success = $stmt->execute([$name, $price, $description, $image, $stock, $discount]);
    //     if ($success) {
    //         return $this->pdo->lastInsertId();
    //     }
    // }

    public function add(
        string $name,
        string $description,
        float $price,
        string $image,
        int $stock,
        float $discount
    ) {
        $sql ='INSERT INTO products (name,price,description,image_url,stock,discount) VALUES (?,?,?,?,?,?)';
        $params = [$name, $price, $description, $image, $stock, $discount];
        $stmt = $this->db->query($sql,$params);

        if($stmt){
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getAll(){
        $sql = 'SELECT * FROM products';
        $params = [];

        return $this->db->fetchAll($sql,$params);;
        // $stmt = $this->db->query($sql,$params);
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id){
        $sql = 'SELECT * FROM products WHERE id = ?';
        $params = [$id];
        return $this->db->fetch($sql,$params);
    }

    public function update(){}
    public function delete(){}
}
