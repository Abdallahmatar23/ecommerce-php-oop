<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session\Session;
use App\Models\ProductRepository;
use App\Models\User;
use App\Repositories\CartItemRepository;
use SessionHandler;

class PageController extends Controller
{



    // public  function show(string $file)
    // {

    //     $products = (new ProductRepository())->getAll();

    //     if ($file == "checkout") {
    //         if (!isset($_SESSION['user'])) {
    //             $this->view("auth/register");
    //         }
    //     }

    //     $this->view("store/{$file}", ["products" => $products]);
    // }
    public  function register()
    {
        $this->view("auth/register");
    }
    public  function login()
    {
        $this->view("auth/login");
    }
    public  function notFound()
    {
        $this->view("store/404");
    }
    public  function home()
    {
        $products = (new ProductRepository())->getAll();
        $this->view("store/home", ["products" => $products]);
    }
    public  function about()
    {
        $this->view("store/about");
    }
    public  function contact()
    {
        $this->view("store/contact");
    }
    public  function cart()
    {
        // $total = 0;
        // $cart_items = (new CartItemRepository())->getCartItems(Session::get("user")['id']) ?? [];

        // foreach ($cart_items as $cart_item) {
        //     $total += $cart_item->getSubTotal();
        // }
        // $this->view("store/cart", ["cart_items" => $cart_items, "total" => $total]);
        $this->view("store/cart");
    }
    public  function checkout()
    {
        $user = (new User())->getById(Session::get("user")['id']);
        $this->view("store/checkout", ["user" => $user]);
    }
    public  function forget_password()
    {
        $this->view("store/forget-password");
    }
}
