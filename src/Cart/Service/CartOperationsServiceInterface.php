<?php

declare(strict_types=1);

namespace App\Cart\Service;


use App\Cart\Entity\Cart;

interface CartOperationsServiceInterface
{
    public function addToCart($user, $tire): Cart;
}