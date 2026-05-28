<?php

namespace App\Core;

use App\Core\Session\Session;
use App\Models\Cart;

abstract class Controller
{
    private int $totalQty = 0;
    private array $cart_items = [];
    public function __construct()
    {
        $this->loadCart();
    }
    public  function view(string  $file, array $data = [])
    {
        // $cart_items = $this->cart_items;
        // $totalQty = $this->totalQty;
        if (getRole() == 'admin') {
            require VIEWS . "layout/admin/header.php";
        } else {
            require VIEWS . "layout/store/header.php";
        }
        if (file_exists(VIEWS . "{$file}.php")) {
            ob_start();
            extract($data);
        
            require VIEWS . "{$file}.php";
            ob_end_flush();
        } else {
            require VIEWS . "store/404.php";
        }
        if (getRole() == 'admin') {
            require VIEWS . "layout/admin/footer.php";
        } else {
            require VIEWS . "layout/store/footer.php";
        }
    }
    public  function loadCart()
    {

        if (Session::getSession('user')) {


            if (!Session::getSession('cart_item') && empty(Session::getSession('cart_item'))) {
                $cart = new Cart();
                $this->cart_items = $cart->getCarts(Session::getSession('user')['id'])?? [];
                $cartData = [];

                if ($this->cart_items) {
                    foreach ($this->cart_items  as $cart_item) {
                        $cartData[] = [
                            "product" => $cart_item->getProduct(),
                            "qty" => $cart_item->getQty()
                        ];

                        $this->totalQty += $cart_item->getQty();
                    }
                    setSession('cart_items', $cartData);
                    setSession('totalQty', $this->totalQty);
                    // $this->cart_items = getSession('cart_items');
                    // $this->totalQty = getSession('totalQty');
                }
            } else {
                $this->cart_items = getSession('cart_items');
                $this->totalQty = getSession('totalQty');
            }
        }
    }
}
