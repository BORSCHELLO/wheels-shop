<?php

declare(strict_types=1);

namespace App\Cart\Service;

use App\Cart\Entity\CartItem;

interface CartServiceInterface
{
    public function addToCart($user, $tire): CartItem;
}