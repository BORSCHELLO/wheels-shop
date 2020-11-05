<?php

declare(strict_types=1);

namespace App\Cart\Repository;


use App\Cart\Entity\Cart;

interface CartRepositoryInterface
{
    public function create(Cart $cart): Cart;
}