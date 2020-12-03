<?php

declare(strict_types=1);

namespace App\OrderItem\Service;


use App\Cart\Collection\CartItemCollection;
use App\Order\Entity\Order;
use App\OrderItem\Entity\OrderItem;

interface OrderItemServiceInterface
{
    public function createOrderItems(Order $order, CartItemCollection $collection): OrderItem;
}