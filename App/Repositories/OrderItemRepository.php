<?php

namespace App\Repositories;

use App\Core\Model;
use App\Models\OrderItem;

class OrderItemRepository extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * جلب كل items بتاعة order معينة كـ OrderItem objects
     * @return OrderItem[]
     */
    public function getByOrderId(int $orderId): array
    {
        $sql = "SELECT oi.id, oi.order_id, oi.product_id, oi.quantity, oi.price
                FROM order_items oi
                WHERE oi.order_id = ?";

        $rows  = $this->fetchAll($sql, [$orderId]);
        $items = [];

        foreach ($rows as $row) {
            $product = (new ProductRepository())->getById($row['product_id']);
            if ($product) {
                $items[] = new OrderItem(
                    $row['id'],
                    $row['order_id'],
                    $product,
                    $row['quantity'],
                    (float) $row['price']
                );
            }
        }

        return $items;
    }

    public function insert(int $orderId, int $productId, int $qty, float $price): void
    {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)";
        $this->query($sql, [$orderId, $productId, $qty, $price]);
    }
}