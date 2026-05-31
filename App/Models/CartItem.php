<?php



namespace App\Models;

use App\Core\Model;
use App\Models\Product;

class CartItem extends Model
{
    private Product $product;
    private int $qty;
    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    public function getProduct()
    {
        return $this->product;
    }
    public function getQty()
    {
        return $this->qty;
    }

    public function setQty(int $qty)
    {
        $this->qty = $this->getQty() + $qty;
    }
    public function getSubTotal()
    {
        return $this->product->getPrice() * $this->qty;
    }

    public  function toArray()
    {

        return [
            "product" => [
                'id' => $this->product->getId(),
                'imagePath' => $this->product->getImage(),
                'title' => $this->product->getName(),
                'description' => $this->product->getDescription(),
                'price' => $this->product->getPrice()
            ],
            "qty" => $this->qty
        ];
    }
    public static function fromArray(array $data)
    {
        $productData = $data['product'];
        $product = new Product($productData['id'], $productData['imagePath'], $productData['title'], $productData['description'], $productData['price']);
        return new self($product, $data['qty']);
    }



    
}
