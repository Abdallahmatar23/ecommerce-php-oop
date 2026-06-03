<?php



namespace App\Repositories;

use App\Core\Model;


class CartRepository extends Model
{
    public function getCartByUser(?int $user_id = null)
    {



        $sql = "SELECT id  FROM cart  WHERE cart.user_id=?";
        $cart = $this->fetch($sql, [$user_id]);
        if ($cart) {
            return $cart['id'];
        }
    }






    public function createCart(int $user_id)
    {
        $sql = "INSERT INTO cart (user_id) values(?)";
        $this->query($sql, [$user_id]);
        return $this->lastInsertId();
    }





    public function deleteAllCart(int $user_id)
    {

        $sql = "DELETE FROM   cart  WHERE user_id=?";
        $this->query($sql, [$user_id]);
    }
}
