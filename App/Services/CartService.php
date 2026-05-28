<?php


namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartService
{
    private array $items = [];
    private Cart $cart;
    private const SESSION_KEY = "cart_items";
    public function __construct()
    {
        $this->cart = new Cart();
        if (hasSession(self::SESSION_KEY) && !empty(getSession(self::SESSION_KEY))) {
            $this->items = $this->loadFromSession(getSession(self::SESSION_KEY));
        } else {
            $this->items = hasSession('user') ? $this->cart->getCarts(getSession('user')['id']) : [];
            $this->saveToSession();
        }
    }

    public function add(int $product_id, int  $qty)
    {
        $product = (new Product())->getProduct($product_id);
        $this->items[] = new CartItem($product, $qty);
        $this->saveToSession();
        
        if ($user = getUser()) {
            $this->cart->addCartToDb($user['id'], $product_id, $qty);
        }
    }
    public function change(int $product_id, int  $qty)
    {
 var_dump(getSession('carts_items'));
 die;
 $user = getUser();
 foreach ($this->items as $key => $item) {
     
     if ($product_id == $item->getProduct()->getId()) {
         $item->setQty($qty);
         if ($item->getQty() < 1) {
             if ($user) $this->cart->deleteCartFromDb($user['id'], $product_id);
             unset($this->items[$key]);
             return;
             }
             if ($user) $this->cart->updateCartFromDb($user['id'], $product_id,  $item->getQty());
             return;
             }
             }
             $this->saveToSession();
             var_dump(getSession('carts_items'));
             die;
    }

    public function remove(int  $product_id)
    {
        $user = getUser();

        foreach ($this->items as $key => $item) {
            if ($item->getProduct()->getId() == $product_id) {
                if ($user) $this->cart->deleteCartFromDb($user['id'], $product_id);
                unset($this->items[$key]);
                return;
            }
        }
        $this->saveToSession();
    }
    public function clearAll()
    {
        $user = getUser();
        $this->items = [];
        deleteSession(self::SESSION_KEY);
        if ($user) $this->cart->deleteAllCartFromDb($user['id']);
    }

    public function getCart()
    {
        return $this->cart;
    }

    private function loadFromSession(array $data)
    {
        $this->items = [];
        foreach ($data as $itemProduct) {
            $this->items[] = CartItem::fromArray($itemProduct);
        }
        return $this->items;
    }
    private function saveToSession()
    {
        $data = [];
        foreach ($this->items as $item) {
            $data[] = $item->toArray();
        }
        setSession(self::SESSION_KEY, $data);
    }
}
