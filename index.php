<?php
ob_start();
require_once 'vendor\autoload.php';
require_once 'Config\db.php';
// var_dump(class_exists(\App\Classes\Models\Product::class));
// die;

use App\Classes\Models\Product\Product;
use App\Classes\Models\Auth\Auth;
use App\Classes\Core\Database\Database;
use App\Classes\Core\Session;

if ($action = Session::flash("action")) {
    Session::get_message($action);
}


$page = $_GET['page'] ?? 'register';

$route = match ($page) {
    'home' => './App/views/store/home.php',
    'dashboard' => './App/views/admin/dashboard.php',
    'products' => './App/views/admin/products.php',
    'add-product' => './App/views/admin/edit-product.php',
    'update-product' => './App/views/admin/edit-product.php',
    'product-details' => './App/views/store/product-details.php',
    'login' => './App/views/auth/login.php',
    'register' => './App/views/auth/register.php',
    'registercontroll' => './App/classes/controllers/AuthController.php',
    '404' => './App/views/store/404.php'
};



$adminPages = ['dashboard', 'products', 'add-product', 'update-product'];
$storePages = ['home', 'product-details','register','registercontroll',"login"];

if (in_array($page, $adminPages)) {
    // require 'App/views/layout/admin/sidebar.php';
    // require 'App/views/layout/admin/nav.php';
    require $route;
    // require 'App/views/layout/admin/footer.php';
}
if (in_array($page, $storePages)) {
    require 'App/views/layout/store/header.php';
    require $route;
    require 'App/views/layout/store/footer.php';
}
