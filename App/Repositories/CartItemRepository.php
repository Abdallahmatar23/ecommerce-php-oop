<?php



namespace App\Repositories;

use App\Core\Model;
use App\Models\CartItem;
use App\Repositories\ProductRepository;

class CartItemRepository extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function addCartItem(int $cart_id, int $product_id, int $qty)
    {
        $sql = "INSERT INTO cart_items  (cart_id,product_id,quantity) values(?,?,?)";
        $this->query($sql, [$cart_id, $product_id, $qty]);
    }
    public function updateCartItem(int $cart_id, int $product_id, int $qty)
    {

        $sql = "UPDATE  cart_items set `quantity`=? WHERE `cart_id`=? and `product_id`=?";
        $this->query($sql, [$qty, $cart_id, $product_id]);
    }



    public function deleteCartItem(int $cart_id, int $product_id)
    {

        $sql = "DELETE FROM   cart_items  WHERE cart_id=? AND product_id=?";
        $this->query($sql, [$cart_id, $product_id]);
    }
    public function deleteCartItems(int $cart_id)
    {

        $sql = "DELETE FROM   cart_items  WHERE cart_id=? ";
        $this->query($sql, [$cart_id]);
    }


    public function getCartItem(int $user_id, int $product_id)
    {
        $sql = "SELECT product_id,quantity FROM cart_items JOIN cart ON cart_items.cart_id = cart.id WHERE cart.user_id=? and cart_items.product_id=?";
        $cart_item = $this->fetch($sql, [$user_id, $product_id]);

        if ($cart_item) {
            $product = (new ProductRepository)->getById($product_id);
            return new CartItem($product, $cart_item['quantity']);;
        }
    }
    public function getCartItems(int $user_id)
    {
        $cart_items = [];
        $sql = "SELECT product_id,quantity FROM cart_items JOIN cart ON cart_items.cart_id = cart.id WHERE cart.user_id=?";
        $rows = $this->fetchAll($sql, [$user_id]);
        if ($rows) {
            foreach ($rows as $row) {
                $product = (new ProductRepository)->getById($row['product_id']);
                $cart_items[] = new CartItem($product, $row['quantity']);
            }

            return $cart_items;
        }
    }
}
