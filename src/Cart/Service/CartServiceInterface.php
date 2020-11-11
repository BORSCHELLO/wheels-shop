<?php

declare(strict_types=1);

namespace App\Cart\Service;

use App\Cart\Collection\CartItemCollection;
use App\Cart\Entity\CartItem;
use App\Tire\Entity\Tire;
use App\User\Entity\User;

interface CartServiceInterface
{
    public function addToCart(User $user, Tire $tire): CartItem;

    public function getItemFromCart(User $user): ?CartItemCollection;

    public function deleteItem($id): void;

    public function incrementItem($id, $quantity): CartItem;

    public function decrementItem($id, $quantity): CartItem;
}