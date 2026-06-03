<?php

namespace App\Models;

class OrderItem
{
    private int    $id;
    private int    $orderId;
    private Product $product;
    private int    $quantity;
    private float  $price;   // السعر وقت الشراء (مش السعر الحالي)

    public function __construct(
        int     $id,
        int     $orderId,
        Product $product,
        int     $quantity,
        float   $price
    ) {
        $this->id       = $id;
        $this->orderId  = $orderId;
        $this->product  = $product;
        $this->quantity = $quantity;
        $this->price    = $price;
    }

    public function getId(): int       { return $this->id; }
    public function getOrderId(): int  { return $this->orderId; }
    public function getProduct(): Product { return $this->product; }
    public function getQuantity(): int { return $this->quantity; }
    public function getPrice(): float  { return $this->price; }

    public function getSubTotal(): float
    {
        return $this->price * $this->quantity;
    }
}