<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Core\Controller;
use App\Services\CartService;

class CartController extends Controller
{
    private CartService $cart_service;
    public function __construct()
    {
        $this->cart_service = new CartService();
    }
    public function index()
    {
        $carts = [];
        if ($user = getUser()) {
            $carts =  $this->cart_service->getCart()->getCarts($user['id']);
        }
        $this->view("pages/cart", ['cart_items' => $carts]);
    }
    public function handle(string $action = "", int $product_id = 1, int $qty = 1)
    {

        switch ($action) {
            case "add":
                $this->cart_service->add($product_id, $qty);
                redirect("product/details/$product_id");
                break;
            case "change":
                $this->cart_service->change($product_id, $qty);
                redirect("product/details/$product_id");
                break;
            case "remove":
                $this->cart_service->remove($product_id);
                redirect("cart");
                break;
            case "clear":
                $this->cart_service->clearAll();
                redirect("cart");
                break;
        }
    }
}
