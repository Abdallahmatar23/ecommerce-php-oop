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
    
    public function handle(string $action = "", int $product_id = 1, int $qty = 1)
    {
        switch ($action) {
            case "add":
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $this->cart_service->add($product_id, $qty);
                }
                redirect("product/details/$product_id");
                break;
            case "change":

                $this->cart_service->change($product_id, $qty);
                redirect("product/details/$product_id");
                break;
            case "remove":
                $this->cart_service->remove($product_id);
                redirect("page/cart");
                break;
            case "clear":
                $this->cart_service->clearAll();
                redirect("page/cart");
                break;
        }
    }
}
