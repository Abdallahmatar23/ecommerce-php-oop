<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session\Session;
use App\Repositories\ProductRepository;
use App\Models\User;
use App\Repositories\CartItemRepository;
use SessionHandler;

class PageController extends Controller
{


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

        $this->view("store/cart");
    }
    public  function checkout()
    {
        if (!Session::check("user")) {
            redirect("login");
        }
        $user = (new User())->getById(Session::get("user")['id']);
        $this->view("store/checkout", ["user" => $user]);
    }
    public  function forget_password()
    {
        $this->view("store/forget-password");
    }
}
