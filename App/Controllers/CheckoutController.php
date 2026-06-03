<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session\Session;
use App\Repositories\OrderRepository;
use App\Services\CartService;

class CheckoutController extends Controller
{
    private OrderRepository $orderRepo;
    private CartService     $cartService;

    public function __construct()
    {
        $this->orderRepo   = new OrderRepository();
        $this->cartService = new CartService();
    }

    /** GET + POST  page/checkout */
    public function checkout()
    {
        if (!Session::check("user")) {
            Session::set("error", "Please login to complete your order.");
            redirect("login");
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect("page/checkout");
        }

        $userId          = Session::get("user")['id'];
        $shippingAddress = trim($_POST['shipping_address'] ?? '');
        $paymentMethod   = trim($_POST['payment_method']   ?? 'cash');

        if (empty($shippingAddress)) {
            Session::set("error", "Shipping address is required.");
            redirect("page/checkout");
        }

        $result = $this->orderRepo->create($userId, $shippingAddress, $paymentMethod);

        if ($result === "stock_error") {
            Session::set("error", "Some items in your cart are out of stock.");
            redirect("page/cart");
        }

        if ($result === false) {
            Session::set("error", "Your cart is empty or something went wrong.");
            redirect("page/cart");
        }

        // نجح — صفّي الـ cart وروّح على صفحة النجاح
        $this->cartService->clearAll();
        // var_dump('ssssss');
        // die;
        redirect("order/success/" . $result);
    }
}