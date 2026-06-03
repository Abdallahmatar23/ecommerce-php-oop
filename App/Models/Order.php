<?php

namespace App\Models;

use App\Core\Model;

class Order extends Model
{
    private int     $id;
    private int     $userId;
    private float   $totalPrice;
    private string  $shippingAddress;
    private string  $paymentMethod;
    private string  $status;
    private string  $createdAt;
    private ?string $userName;   // من الـ JOIN — موجود في admin queries بس

    public function __construct(
        int     $id,
        int     $userId,
        float   $totalPrice,
        string  $shippingAddress,
        string  $paymentMethod,
        string  $status,
        string  $createdAt,
        ?string $userName = null
    ) {
        $this->id              = $id;
        $this->userId          = $userId;
        $this->totalPrice      = $totalPrice;
        $this->shippingAddress = $shippingAddress;
        $this->paymentMethod   = $paymentMethod;
        $this->status          = $status;
        $this->createdAt       = $createdAt;
        $this->userName        = $userName;
    }

    public function getId(): int                 { return $this->id; }
    public function getUserId(): int             { return $this->userId; }
    public function getTotalPrice(): float       { return $this->totalPrice; }
    public function getShippingAddress(): string { return $this->shippingAddress; }
    public function getPaymentMethod(): string   { return $this->paymentMethod; }
    public function getStatus(): string          { return $this->status; }
    public function getCreatedAt(): string       { return $this->createdAt; }
    public function getUserName(): ?string       { return $this->userName; }
}