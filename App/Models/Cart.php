  <?php



    namespace App\Models;

    use App\Core\Model;
use App\Core\Session\Session;
use App\Models\CartItem;
    use App\Models\Product;
    use PDO;

    class Cart extends Model
    {

        public function __construct()
        {
            parent::__construct();
        }


        public function getCart(int $product_id, ?int $user_id = null)
        {
            $product = (new Product())->getProduct($product_id);
            if (getUser()) {
                $sql = "SELECT * FROM  carts WHERE user_id=?AND product_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$user_id, $product_id]);
                $cart = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($cart) {
                    return new CartItem($product, $cart['quantity']);
                }
            } else {
                $carts = Session::getSession('cart_items');
                foreach ($carts as $cart) {
                    if ($cart['product']['id'] == $product_id) {
                        $product = new Product($cart['product']['id'], $cart['product']['imagePath'], $cart['product']['title'], $cart['product']['description'], $cart['product']['price']);

                        return new CartItem($product, $cart['quantity']);
                    }
                }
            }
        }

        public function getCarts(int $user_id)
        {
            $sql = "SELECT * FROM  carts where user_id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id]);
            $carts = [];
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($rows) {
                foreach ($rows as $row) {
                    $product = (new Product)->getProduct($row['product_id']);
                    $carts[] = new CartItem($product, $row['quantity']);
                }
                return $carts;
            }
        }




        public function addCartToDb(int $user_id, int $product_id, int $qty)
        {

            $sql = "INSERT INTO carts (user_id,product_id,quantity) values(?,?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id, $product_id, $qty]);
        }




        public function updateCartFromDb(int $user_id, int $product_id, int $qty)
        {

            $sql = "UPDATE  carts set `quantity`=? WHERE `user_id`=? and `product_id`=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$qty, $user_id, $product_id]);
        }



        public function deleteCartFromDb(int $user_id, int $product_id)
        {

            $sql = "DELETE FROM   carts  WHERE user_id=? AND product_id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id, $product_id]);
        }
        public function deleteAllCartFromDb(int $user_id)
        {

            $sql = "DELETE FROM   carts  WHERE user_id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id]);
        }
    }
