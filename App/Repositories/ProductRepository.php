<?php

namespace App\Models;

use App\Core\Model;

class ProductRepository extends Model
{
    public function add(
        string $name,
        string $description,
        float $price,
        string $image,
        int $stock,
        float $discount
    ) {
        $sql = 'INSERT INTO products (name,price,description,image_url,stock,discount) VALUES (?,?,?,?,?,?)';
        $params = [$name, $price, $description, $image, $stock, $discount];
        $stmt = $this->query($sql, $params);

        if ($stmt) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM products';
        $params = [];

        $rows = $this->fetchAll($sql, $params);
        $products = [];
        foreach ($rows as $row) {
            $products[] = new Product($row['id'], $row['image_url'], $row['name'], $row['description'], $row['price'], $row['stock'], $row['discount']);
        }
        return $products;
        // $stmt = $this->db->query($sql,$params);
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getById(int $id)
    {
        $sql = 'SELECT * FROM products WHERE id = ?';
        $params = [$id];
        $product = $this->fetch($sql, $params);
        if ($product) {
            return new Product($product['id'], $product['image_url'], $product['name'], $product['description'], $product['price'], $product['stock'], $product['discount']);
        }
    }
    public function getCreationTime(int $id)
    {
        $sql = 'SELECT created_at FROM products WHERE id = ?';
        $params = [$id];
        return $this->fetch($sql, $params);
    }

    public function update(int $id, string $name, string $description, float $price, string $image, int $stock, float $discount)
    {
        $sql = 'UPDATE products SET name = ? , description = ? , price = ? , image_url = ? ,stock = ? ,discount = ? WHERE id = ?';
        $param = [$name, $description, $price, $image, $stock, $discount, $id];
        $this->query($sql, $param);
    }
    public function delete(int $id)
    {
        $sql = 'DELETE FROM products WHERE id = ? ';
        $param = [$id];
        $this->query($sql, $param);
    }
}
