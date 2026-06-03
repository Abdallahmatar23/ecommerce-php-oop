<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;
use App\Core\Session\Session;

class OrderController extends Controller
{
    private Order $orderModel;

    public function __construct()
    {
        $this->orderModel = new Order();
    }

    public function orders()
    {
        $allOrders = $this->orderModel->getAllOrders();
        return $this->view("store/my_orders", ["orders" => $allOrders]);
    }


    // عرض تاريخ طلبات العميل الحالي
    public function myOrders()
    {
        if (!Session::check("user")) {
            redirect("login");
        }
        $userId = Session::get("user")['id'];
        $orders = $this->orderModel->getUserOrders($userId);

        return $this->view("store/my_orders", ["orders" => $orders]);
    }

    // تحديث حالة الطلب من قبل الـ Admin
    public function updateStatus($orderId)
    {
        if (!Session::check("user") || Session::get("user")['role'] === 'user') {
            redirect("home");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newStatus = $_POST['status'] ?? 'pending';
            $this->orderModel->updateOrderStatus($orderId, $newStatus);
            Session::set("success", "Order status updated successfully.");
            redirect("admin/orders");
        }
    }
}
