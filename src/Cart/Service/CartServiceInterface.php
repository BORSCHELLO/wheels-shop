<?php

declare(strict_types=1);

namespace App\Cart\Service;

use App\Cart\Collection\CartItemCollection;
use App\Cart\Entity\CartItem;
use App\Tire\Entity\Tire;
use App\User\Entity\User;

interface CartServiceInterface
{
    const MIN_DISCOUNT_PRICE = 400;

    const DISCOUNT_RATE = 0.05;

    public function addToCart(User $user, Tire $tire): CartItem;

    public function getItemFromCart(User $user): ?CartItemCollection;

    public function deleteItem(CartItem $cartItem): void;

    public function incrementQuantity(User $user, CartItem $cartItem, int $quantity): ?CartItem;

    public function decrementQuantity(User $user, CartItem $cartItem, int $quantity): ?CartItem;

    public function getTotalPrice(CartItemCollection $collection): float;

    public function getDiscount(CartItemCollection $collection): float;

    public function getTotalCost(CartItemCollection $collection): float;

    public function mergeUsersCart(User $user, User $anonymousUser): void;

    public function isEmpty(User $user): bool;
}