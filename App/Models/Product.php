<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Model;

// require_once __DIR__ . "/../Core/Database.php";  
// require_once "../Core/Database.php";
// use PDO;    



class Product extends  Model
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private string $image;
    private int $stock;
    private float $discount;
    private string $created_at;


    public function __construct(int $id = 0, string $img = "", string $title = "", string $des = "", float $price = 0, int $stock = 0, float $discount = 0, string $created_at = "" )
    {
        parent::__construct();
        $this->id = $id;
        $this->image = $img;
        $this->name = $title;
        $this->price = $price;
        $this->description = $des;
        $this->stock = $stock;
        $this->discount = $discount;
        $this->created_at = $created_at;
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
    public function getId()
    {
        return $this->id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setImage(string $image)
    {
        $this->image = $image;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setDiscount(float $discount)
    {
        $this->discount = $discount;
    }
    // public function getCreationTime()
    // {
    //     return $this->creationTime;
    // }

    public function priceAfterDiscount()
    {
        return $this->price - ($this->price * $this->discount);
    }

    // public function add(
    //     string $name,
    //     string $description,
    //     float $price,
    //     string $image,
    //     int $stock,
    //     float $discount
    // ) {
    //     $sql = 'INSERT INTO products (name,price,description,image_url,stock,discount) VALUES (?,?,?,?,?,?)';
    //     $params = [$name, $price, $description, $image, $stock, $discount];
    //     $stmt = $this->query($sql, $params);

    //     if ($stmt) {
    //         return $this->db->lastInsertId();
    //     }
    //     return false;
    // }

    // public function getAll()
    // {
    //     $sql = 'SELECT * FROM products';
    //     $params = [];

    //     $rows = $this->fetchAll($sql, $params);
    //     $products = [];
    //     foreach ($rows as $row) {
    //         $products[] = new Product($row['id'], $row['image_url'], $row['name'], $row['description'], $row['price'], $row['stock'], $row['discount']);
    //     }
    //     return $products;
    //     // $stmt = $this->db->query($sql,$params);
    //     // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getById(int $id)
    // {
    //     $sql = 'SELECT * FROM products WHERE id = ?';
    //     $params = [$id];
    //     return $this->fetch($sql, $params);
    // }

    // public function update() {}
    // public function delete() {}
}
