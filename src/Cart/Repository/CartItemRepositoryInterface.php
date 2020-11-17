<?php

declare(strict_types=1);

namespace App\Cart\Repository;

use App\Cart\Collection\CartItemCollection;
use App\Cart\Entity\CartItem;
use App\Tire\Entity\Tire;
use App\User\Entity\User;

interface CartItemRepositoryInterface
{
    public function create(CartItem $cartItem): CartItem;

    public function update(CartItem $cartItem): CartItem;

    public function increaseQuantity(CartItem $cartItem, int $quantity = 1): CartItem;

    public function findByUserAndTire(User $user, Tire $tire): ?CartItem;

    public function getItemCollection(User $user): ?CartItemCollection;

    public function findById(int $id): CartItem;

    public function delete(int $id): void;
}