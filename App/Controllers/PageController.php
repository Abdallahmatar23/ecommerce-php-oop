<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProductRepository;

class PageController extends Controller
{


    public  function show(string $file)
    {

        $products = (new ProductRepository())->getAll();

        if ($file == "checkout") {
            if (!isset($_SESSION['user'])) {
                $this->view("auth/register");
            }
        }

        $this->view("store/{$file}", ["products" => $products]);
    }
}
