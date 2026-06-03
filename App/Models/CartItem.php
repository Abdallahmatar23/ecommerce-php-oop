<?php



namespace App\Models;

use App\Models\Product;

class CartItem 
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
  
}
