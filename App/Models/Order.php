<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use PDOException;

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    // إنشاء طلب جديد ونقل المنتجات من السلة وتحديث المخزون
    public function createOrder($userId, $shippingAddress, $paymentMethod)
    {
        try {
            $this->db->beginTransaction();

            // جلب المنتجات من السلة بناءً على الـ user_id والـ SQL الخاص بالتيم
            $cartQuery = "SELECT cart_items.product_id, cart_items.quantity, products.price, products.stock 
                          FROM cart 
                          JOIN cart_items ON cart.id = cart_items.cart_id 
                          JOIN products ON cart_items.product_id = products.id 
                          WHERE cart.user_id = :user_id";
            
            $stmt = $this->db->prepare($cartQuery);
            $stmt->execute(['user_id' => $userId]);
            $cartItems = $stmt->fetchAll(PDO::ATTR_DEFAULT_FETCH_MODE);

            if (empty($cartItems)) {
                $this->db->rollBack();
                return false; 
            }

            // حساب الإجمالي والتحقق من المخزون
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                if ($item['stock'] < $item['quantity']) {
                    $this->db->rollBack();
                    return "stock_error"; 
                }
                $totalPrice += $item['price'] * $item['quantity'];
            }

            // إدخال الطلب الرئيسي
            $orderQuery = "INSERT INTO orders (user_id, total_price, shipping_address, payment_method, status) 
                           VALUES (:user_id, :total_price, :shipping_address, :payment_method, 'pending')";
            $stmt = $this->db->prepare($orderQuery);
            $stmt->execute([
                'user_id'          => $userId,
                'total_price'      => $totalPrice,
                'shipping_address' => $shippingAddress,
                'payment_method'   => $paymentMethod
            ]);
            
            $orderId = $this->db->lastInsertId();

            // إدخال تفاصيل المنتجات وتحديث المخزون
            $itemQuery = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                          VALUES (:order_id, :product_id, :quantity, :price)";
            $updateStockQuery = "UPDATE products SET stock = stock - :quantity WHERE id = :product_id";
            
            $stmtItem = $this->db->prepare($itemQuery);
            $stmtStock = $this->db->prepare($updateStockQuery);

            foreach ($cartItems as $item) {
                $stmtItem->execute([
                    'order_id'   => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price']
                ]);

                $stmtStock->execute([
                    'quantity'   => $item['quantity'],
                    'product_id' => $item['product_id']
                ]);
            }

            $this->db->commit();
            return $orderId;

        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // جلب طلبات مستخدم معين لصفحة الـ Profile بتاعته
    public function getUserOrders($userId)
    {
        $query = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::ATTR_DEFAULT_FETCH_MODE);
    }

    // جلب تفاصيل طلب محدد مع المنتجات الخاصة به
    public function getOrderDetails($orderId)
    {
        $query = "SELECT order_items.*, products.name, products.image_url 
                  FROM order_items 
                  JOIN products ON order_items.product_id = products.id 
                  WHERE order_items.order_id = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::ATTR_DEFAULT_FETCH_MODE);
    }

    // جلب كل الطلبات (خاص بالـ Admin)
    public function getAllOrders()
    {
        $query = "SELECT orders.*, users.name as user_name FROM orders 
                  JOIN users ON orders.user_id = users.id 
                  ORDER BY orders.created_at DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::ATTR_DEFAULT_FETCH_MODE);
    }

    // تحديث حالة الطلب (خاص بالـ Admin)
    public function updateOrderStatus($orderId, $status)
    {
        $query = "UPDATE orders SET status = :status, updated_at = CURRENT_TIMESTAMP WHERE id = :order_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['status' => $status, 'order_id' => $orderId]);
    }
}