<?php

declare(strict_types=1);

namespace App\OrderItem\Repository;


use App\OrderItem\Entity\OrderItem;

interface OrderItemRepositoryInterface
{
    public function create(OrderItem $orderItem): OrderItem;
}