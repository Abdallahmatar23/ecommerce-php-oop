<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;
use App\Core\Session\Session;
use App\Services\CartService;

class CheckoutController extends Controller
{
    private Order $orderModel;
    private CartService $cartService;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->cartService = new CartService();
    }

    public function index()
    {
        if (!Session::check("user")) {
            Session::set("error", "Please login to complete your order.");
            redirect("login");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = Session::get("user")['id'];
            $shippingAddress = trim($_POST['shipping_address'] ?? '');
            $paymentMethod = trim($_POST['payment_method'] ?? 'cash');

            if (empty($shippingAddress)) {
                Session::set("error", "Shipping address is required.");
                redirect("page/checkout");
            }

            $result = $this->orderModel->createOrder($userId, $shippingAddress, $paymentMethod);

            if ($result === "stock_error") {
                Session::set("error", "Some items in your cart are out of stock.");
                redirect("page/cart");
            } elseif ($result) {
                // تصفية السلة بعد نجاح الطلب
                $this->cartService->clearAll();
                
                Session::set("success", "Your order has been placed successfully!");
                redirect("order/success/" . $result);
            } else {
                Session::set("error", "Something went wrong. Please try again.");
                redirect("page/checkout");
            }
        }
    }
}