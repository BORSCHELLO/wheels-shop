<?php

declare(strict_types=1);

namespace App\Order\Service;

use App\Cart\Collection\CartItemCollection;
use App\Order\Entity\Order;
use App\Request\Dto\CreateOrderRequestDto;
use App\User\Entity\User;

interface OrderServiceInterface
{
    const DELIVERY_COST = 15;

    public function createOrder(
        CreateOrderRequestDto $requestDto,
        User $user,
        int $deliveryCost = self::DELIVERY_COST
    ): Order;
}