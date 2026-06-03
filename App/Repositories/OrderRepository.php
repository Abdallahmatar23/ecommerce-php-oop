<?php

namespace App\Repositories;

use App\Core\Model;
use App\Models\Order;
use PDOException;

class OrderRepository extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------
    // helpers
    // ------------------------------------------------

    private function mapToObject(array $row): Order
    {
        return new Order(
            (int)    $row['id'],
            (int)    $row['user_id'],
            (float)  $row['total_price'],
            $row['shipping_address'],
            $row['payment_method'],
            $row['status'],
            $row['created_at'],
            $row['user_name'] ?? null
        );
    }

    // ------------------------------------------------
    // READ
    // ------------------------------------------------

    /** @return Order[] */
    public function getAll(): array
    {
        $sql  = "SELECT orders.*, users.name AS user_name
                 FROM orders
                 JOIN users ON orders.user_id = users.id
                 ORDER BY orders.created_at DESC";

        $rows = $this->fetchAll($sql, []);
        return array_map(fn($r) => $this->mapToObject($r), $rows);
    }

    public function getById(int $orderId): ?Order
    {
        $sql = "SELECT orders.*, users.name AS user_name
                FROM orders
                JOIN users ON orders.user_id = users.id
                WHERE orders.id = ?";

        $row = $this->fetch($sql, [$orderId]);
        return $row ? $this->mapToObject($row) : null;
    }

    /** @return Order[] */
    public function getByUserId(int $userId): array
    {
        $sql  = "SELECT * FROM orders
                 WHERE user_id = ?
                 ORDER BY created_at DESC";

        $rows = $this->fetchAll($sql, [$userId]);
        return array_map(fn($r) => $this->mapToObject($r), $rows);
    }

    // ------------------------------------------------
    // WRITE
    // ------------------------------------------------

    /**
     * @return int|false|string   orderId | false | "stock_error"
     */
    public function create(int $userId, string $shippingAddress, string $paymentMethod): int|false|string
    {
        try {
            $this->db->beginTransaction();

            $cartItems = $this->fetchAll(
                "SELECT ci.product_id, ci.quantity, p.price, p.stock
                 FROM cart
                 JOIN cart_items ci ON cart.id = ci.cart_id
                 JOIN products   p  ON ci.product_id = p.id
                 WHERE cart.user_id = ?",
                [$userId]
            );

            if (empty($cartItems)) {
                $this->db->rollBack();
                return false;
            }

            $totalPrice = 0;
            foreach ($cartItems as $item) {
                if ($item['stock'] < $item['quantity']) {
                    $this->db->rollBack();
                    return "stock_error";
                }
                $totalPrice += $item['price'] * $item['quantity'];
            }

            $this->query(
                "INSERT INTO orders (user_id, total_price, shipping_address, payment_method, status)
                 VALUES (?, ?, ?, ?, 'pending')",
                [$userId, $totalPrice, $shippingAddress, $paymentMethod]
            );
            $orderId = (int) $this->lastInsertId();

            foreach ($cartItems as $item) {
                $this->query(
                    "INSERT INTO order_items (order_id, product_id, quantity, price)
                     VALUES (?, ?, ?, ?)",
                    [$orderId, $item['product_id'], $item['quantity'], $item['price']]
                );
                $this->query(
                    "UPDATE products SET stock = stock - ? WHERE id = ?",
                    [$item['quantity'], $item['product_id']]
                );
            }

            $this->db->commit();
            return $orderId;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function updateStatus(int $orderId, string $status): bool
    {
        $stmt = $this->query(
            "UPDATE orders SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [$status, $orderId]
        );
        return $stmt->rowCount() > 0;
    }
}
