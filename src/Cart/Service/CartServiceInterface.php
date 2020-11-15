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

    public function deleteItem(int $id): void;

    public function incrementItem(int $id, int $quantity): CartItem;

    public function decrementItem(int $id, int $quantity): CartItem;

    public function getTotalPrice(CartItemCollection $collection): float;

    public function getDiscount(CartItemCollection $collection): float;

    public function getTotalCost(CartItemCollection $collection): float;
}