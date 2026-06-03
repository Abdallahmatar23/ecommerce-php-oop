<?php


namespace App\Services;

use App\Core\Session\Session;
use App\Models\CartItem;
use App\Repositories\ProductRepository;
use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;

class CartService
{
    private array $items = [];
    private CartItemRepository $cartItemRepository;
    private CartRepository $cartRepository;
    private const SESSION_KEY = "cart_items";
    public function __construct()
    {
        $this->cartItemRepository = new CartItemRepository();
        $this->cartRepository = new CartRepository();
        if (Session::get("user")) {

            $this->items =  $this->cartItemRepository->getCartItems(Session::get("user")['id']) ?? [];
        } else {

            redirect("login");
        }
    }

    public function add(int $product_id, int  $qty)
    {



        if (Session::check('user')) {
            if (!$this->cartRepository->getCartByUser(Session::get('user')['id'])) {
                $this->cartRepository->createCart(Session::get('user')['id']);
                $cart_id = $this->cartRepository->getCartByUser(Session::get('user')['id']);
                $this->cartItemRepository->addCartItem($cart_id, $product_id, $qty);
            } else {

                $cart_id = $this->cartRepository->getCartByUser(Session::get('user')['id']);

                $this->cartItemRepository->addCartItem($cart_id, $product_id, $qty);
            }
        }
    }

    public function change(int $product_id, int  $qty)
    {


        foreach ($this->items as $key => $item) {

            if ($product_id == $item->getProduct()->getId()) {
                $item->setQty($qty);
                $cart_id = $this->cartRepository->getCartByUser(Session::get('user')['id']);
                if ($item->getQty() < 1) {
                    $this->cartItemRepository->deleteCartItem($cart_id, $product_id);
                    unset($this->items[$key]);
                    return;
                }
                $this->cartItemRepository->updateCartItem($cart_id, $product_id,  $item->getQty());
                return;
            }
        }
    }

    public function remove(int  $product_id)
    {

        $user = Session::get('user');
        foreach ($this->items as $key => $item) {
            if ($item->getProduct()->getId() == $product_id) {
                $cart_id = $this->cartRepository->getCartByUser($user['id']);

                if ($user)  $this->cartItemRepository->deleteCartItem($cart_id, $product_id);

                unset($this->items[$key]);
                return;
            }
        }
    }
    public function clearAll()
    {
        $user = Session::get('user');
        $this->items = [];
        $cart_id = $this->cartRepository->getCartByUser($user['id']);
        if ($user) $this->cartItemRepository->deleteCartItems($cart_id);
    }
}
