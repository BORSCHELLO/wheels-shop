<?php

declare(strict_types=1);

namespace App\Cart\Service;


use App\Cart\Entity\CartItem;
use App\Cart\Repository\CartItemRepositoryInterface;

class CartService implements CartServiceInterface
{
    private CartItemRepositoryInterface $cartItemRepository;

    public function __construct(CartItemRepositoryInterface $cartRepository)
    {
        $this->cartItemRepository = $cartRepository;
    }

    public function addToCart($user, $tire): CartItem
    {
        $item = $this->cartItemRepository->findByUser($user, $tire);

        if ($item !== null) {
            return $this->cartItemRepository->increaseQuantity($item, 1);
        }

        $cartItem = new CartItem();
        $cartItem->setQuantity(1);
        $cartItem->setTire($tire);
        $cartItem->setUser($user);

        return $this->cartItemRepository->create($cartItem);
    }
}