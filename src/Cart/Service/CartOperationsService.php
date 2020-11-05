<?php

declare(strict_types=1);

namespace App\Cart\Service;


use App\Cart\Entity\Cart;
use App\Cart\Repository\CartRepositoryInterface;

class CartOperationsService implements CartOperationsServiceInterface
{
    private CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addToCart($user, $tire): Cart
    {
        $cart = new Cart();
        $cart->setCount(1);
        $cart->setTire($tire);
        $cart->setUser($user);

        return $this->cartRepository->create($cart);
    }

}