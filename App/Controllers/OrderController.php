<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session\Session;
use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;

class OrderController extends Controller
{
    private OrderRepository     $orderRepo;
    private OrderItemRepository $orderItemRepo;

    public function __construct()
    {
        $this->orderRepo     = new OrderRepository();
        $this->orderItemRepo = new OrderItemRepository();
    }

    // ================================================
    // USER
    // ================================================

    /** GET order/myOrders */
    public function myOrders()
    {
        if (!Session::check("user")) {
            redirect("login");
        }

        $userId = Session::get("user")['id'];
        $orders = $this->orderRepo->getByUserId($userId);

        return $this->view("store/my_orders", ["orders" => $orders]);
    }

    /** GET order/details/{id} */
    public function details(int $orderId)
    {
        if (!Session::check("user")) {
            redirect("login");
        }

        $order = $this->orderRepo->getById($orderId);


        if (!$order || $order['user_id'] != Session::get("user")['id']) {
            return $this->view("store/404");
        }

        $orderItems = $this->orderItemRepo->getByOrderId($orderId);

        return $this->view("store/order_details", [
            "order"      => $order,
            "orderItems" => $orderItems,
        ]);
    }

    /** GET order/success/{id} */
    public function success(int $orderId)
    {
        if (!Session::check("user")) {
            redirect("login");
        }

        $order = $this->orderRepo->getById($orderId);

        if (!$order || $order->getId() != Session::get("user")['id']) {
            return $this->view("store/404");
        }

        $orderItems = $this->orderItemRepo->getByOrderId($orderId);

        return $this->view("store/order_success", [
            "order"      => $order,
            "orderItems" => $orderItems,
        ]);
    }

    // ================================================
    // ADMIN
    // ================================================

    /** GET order/orders */
    public function orders()
    {
        $this->requireAdmin();

        $allOrders = $this->orderRepo->getAll();
        return $this->view("admin/orders", ["allOrders" => $allOrders]);
    }

    /** GET order/adminDetails/{id} */
    public function adminDetails(int $orderId)
    {
        $this->requireAdmin();

        $order = $this->orderRepo->getById($orderId);

        if (!$order) {
            return $this->view("store/404");
        }

        $orderItems = $this->orderItemRepo->getByOrderId($orderId);

        return $this->view("admin/admin_order_details", [
            "order"      => $order,
            "orderItems" => $orderItems,
        ]);
    }

    /** POST order/updateStatus/{id} */
    public function updateStatus(int $orderId)
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newStatus = $_POST['status'] ?? 'pending';
            $this->orderRepo->updateStatus($orderId, $newStatus);
            Session::set("success", "Order status updated successfully.");
        }

        redirect("order/orders");
    }

    // ================================================
    // HELPERS
    // ================================================

    private function requireAdmin(): void
    {
        if (!Session::check("user") || Session::get("user")['role'] === 'user') {
            redirect("home");
        }
    }
}