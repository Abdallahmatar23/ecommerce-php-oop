<?php

namespace App\Core;

use App\Core\Session\Session;
use App\Models\Cart;
use App\Models\CartItem;
use App\Repositories\CartItemRepository;
use App\Services\CartService;

abstract class Controller
{
    private int $total = 0;
    private int $totalQty = 0;
    private array $cart_items = [];
    public function __construct() {}
    public  function view(string  $file, array $data = [])
    {
        $this->loadCart();
        $cart_items = $this->cart_items;
        $totalQty = $this->totalQty;
        $total = $this->total;

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

        if (Session::get('user')) {


            // if (!Session::get('cart_item') && empty(Session::get('cart_item'))) {
            // $cartData = [];
            $cart_items = (new CartItemRepository())->getCartItems(Session::get('user')['id']);

            if ($cart_items) {
                foreach ($cart_items  as $cart_item) {


                    $this->totalQty += $cart_item->getQty();
                    $this->total += $cart_item->getSubTotal();
                }
                $this->cart_items = $cart_items;
                // Session::set('cart_items', $cartData);
                // Session::set('totalQty', $this->totalQty);
                // Session::set('total', $this->total);
                // $this->cart_items = getSession('cart_items');
                // $this->totalQty = getSession('totalQty');
            }
        } else {
            $data = [];
            foreach (Session::get('cart_items') as $cart_item) {
                $data[] =CartItem::fromArray($cart_item);
           
                
                }
                $this->cart_items =$data;
                $this->totalQty =Session::get("totalQty");
                $this->total =Session::get("total");
        }
        // } else {
        // }
    }
}
