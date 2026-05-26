<?php

require_once 'vendor\autoload.php';
require_once 'Config\db.php';
// var_dump(class_exists(\App\Classes\Models\Product::class));
// die;

use App\Classes\Models\Product;
use App\Classes\Core\Database;


$page = $_GET['page'] ?? 'home';
$page = explode('&', $page)[0];

$db = new Database;
$pdo = $db->connect();

$route = match ($page) {
    'home'            => './App/views/store/home.php',
    'dashboard'       => './App/views/admin/dashboard.php',
    'products'        => './App/views/admin/products.php',
    'add-product'     => './App/views/admin/add-product.php',
    'update-product'  => './App/views/admin/edit-product.php',
    'product-details' => './App/views/store/product-details.php',
    // 'view-products' => (new ProductController($repo))->index(),
    // 'create-product' => ((new ProductController($repo))->create()),
    // 'add-product' => ((new ProductController($repo))->store()),
    // 'update-product'  => ((new ProductController($repo))->update()),
    // 'delete-product' => ((new ProductController($repo))->delete()),
    '404'             => './App/views/store/404.php'
};



$adminPages = ['dashboard', 'products', 'add-product', 'update-product'];
$storePages = ['home', 'product-details'];

if (in_array($page, $adminPages)) {
    require 'App/views/layout/admin/sidebar.php';
    require 'App/views/layout/admin/nav.php';
    require $route;
    require 'App/views/layout/admin/footer.php';
}
if (in_array($page, $storePages)) {
    require 'App/views/layout/store/header.php';
    require $route;
    require 'App/views/layout/store/footer.php';
}
