<?php

declare(strict_types=1);

namespace App\Cart\Service;

use App\Cart\Collection\CartItemCollection;
use App\Cart\Entity\CartItem;
use App\Cart\Repository\CartItemRepositoryInterface;
use App\Tire\Entity\Tire;
use App\User\Entity\User;

class CartService implements CartServiceInterface
{
    private CartItemRepositoryInterface $cartItemRepository;

    public function __construct(CartItemRepositoryInterface $cartRepository)
    {
        $this->cartItemRepository = $cartRepository;
    }

    public function addToCart(User $user, Tire $tire): CartItem
    {
        $item = $this->cartItemRepository->findByUserAndTire($user, $tire);

        if ($item !== null) {
            return $this->cartItemRepository->increaseQuantity($item, 1);
        }

        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setTire($tire);
        $cartItem->setUser($user);

        return $this->cartItemRepository->create($cartItem);
    }

    public function getItemFromCart(User $user): ?CartItemCollection
    {
        return $this->cartItemRepository->getItemCollection($user);
    }

    public function deleteItem(int $id): void
    {
        $this->cartItemRepository->delete($id);
    }

    public function incrementItem(int $id, int $quantity): CartItem
    {
        $item = $this->cartItemRepository->findById($id);
        $item->increaseQuantity($quantity);
        $this->cartItemRepository->create($item);

        return $item;
    }

    public function decrementItem(int $id, int $quantity): CartItem
    {
        $item = $this->cartItemRepository->findById($id);
        $item->decreaseQuantity($quantity);
        $this->cartItemRepository->create($item);

        return $item;
    }
}