<?php
ob_start();
require_once 'vendor\autoload.php';
require_once 'Config\db.php';


use App\Classes\Models\Product\Product;
use App\Classes\Models\Auth\Auth;
use App\Classes\Core\Database\Database;
use App\Classes\Core\Session;


if ($action = Session::flash("action")) {
    Session::get_message($action);
}
if (
    !Session::check("user") &&
    isset($_COOKIE["user_id"]) &&
    isset($_COOKIE["user_role"])
) {

    Session::set(
        "user",
        [
            "id" => $_COOKIE["user_id"],
            "role" => $_COOKIE["user_role"]
        ]
    );
}


$page = $_GET['page'] ?? 'home';

$route = match ($page) {
    'home' => './App/views/store/home.php',
    'dashboard' => './App/views/admin/dashboard.php',
    'products' => './App/views/admin/products.php',
    'add-product' => './App/views/admin/edit-product.php',
    'update-product' => './App/views/admin/edit-product.php',
    'product-details' => './App/views/store/product-details.php',
    'login' => './App/views/auth/login.php',
    'register' => './App/views/auth/register.php',
    'contact' => './App/views/store/contact.php',
    'ViewUsers' => './App/views/admin/View_Users.php',
    'AddUsers' => './App/views/admin/Add_Users.php',
    'update_user' => './App/views/admin/update-user.php',
    'ContactsUsers' => './App/views/admin/contacts-user.php',
    'logincontroll', 'registercontroll', 'logoutcontroll' => './App/classes/controllers/AuthController.php',
    'Addusercontroll', 'deleteusercontroll', 'updateusercontroll', 'infousercontroll' => './App/classes/controllers/UserController.php',
    'contactcontroller','readcontactcontroll' => './App/classes/controllers/ContactController.php',
    '404' => './App/views/store/404.php'
};


$adminPages = ['dashboard', 'products', 'add-product', 'update-product', 'ViewUsers', 'AddUsers', 'Addusercontroll', 'deleteusercontroll', 'updateusercontroll', 'update_user', 'infousercontroll', 'ContactsUsers','readcontactcontroll'];

$storePages = ['home', 'product-details', 'register', 'registercontroll', 'login', 'logincontroll', 'logoutcontroll', 'contact', 'contactcontroller'];

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
if($page=="404"){
    require './App/views/store/404.php';
}