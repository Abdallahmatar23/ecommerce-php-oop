<?php

namespace App\Models;


use App\Core\Model;
use App\Models\Product;

class Cart extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    // public function getCart(int $product_id, ?int $user_id = null)
    // public function getCart(?int $user_id = null)
    // {

    //     if (getUser()) {

    //         $sql = "SELECT *  FROM cart_items JOIN cart ON cart_items.cart_id = cart.id WHERE cart.user_id=?";
    //         $cart = $this->fetch($sql, [$user_id]);
    //         if ($cart) {
    //             $product = (new ProductRepository())->getById($cart['product_id']);

    //             return new CartItem($product, $cart['quantity']);
    //         }
    //     }
    // }
   
    // else {
    //     $carts = Session::getSession('cart_items');
    //     foreach ($carts as $cart) {
    //         if ($cart['product']['id'] == $product_id) {
    //             $product = new Product($cart['product']['id'], $cart['product']['imagePath'], $cart['product']['title'], $cart['product']['description'], $cart['product']['price']);
    //             return new CartItem($product, $cart['quantity']);
    //         }



}
