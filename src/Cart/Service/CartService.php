<?php

declare(strict_types=1);

namespace App\Cart\Service;

use App\Cart\Collection\CartItemCollection;
use App\Cart\Entity\CartItem;
use App\Cart\Repository\CartItemRepositoryInterface;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use App\User\Repository\UserRepositoryInterface;

class CartService implements CartServiceInterface
{
    private CartItemRepositoryInterface $cartItemRepository;

    private UserRepositoryInterface $userRepository;

    public function __construct(CartItemRepositoryInterface $cartRepository, UserRepositoryInterface $userRepository)
    {
        $this->cartItemRepository = $cartRepository;

        $this->userRepository = $userRepository;
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

    public function deleteItem(CartItem $cartItem): void
    {
        $this->cartItemRepository->delete($cartItem);
    }

    public function incrementItem(User $user, CartItem $cartItem, int $quantity): ?CartItem
    {
        if ($cartItem->getUser() == $user) {
            $cartItem->increaseQuantity($quantity);
            $this->cartItemRepository->create($cartItem);

            return $cartItem;
        }

        return null;
    }

    public function decrementItem(User $user, CartItem $cartItem, int $quantity): ?CartItem
    {
        if ($cartItem->getUser() == $user) {
            $cartItem->decreaseQuantity($quantity);
            $this->cartItemRepository->create($cartItem);

            return $cartItem;
        }

        return null;
    }

    public function getTotalPrice(CartItemCollection $collection): float
    {
        $totalPrice = [];
        if ($collection) {
            foreach ($collection as $elem) {
                $totalPrice[] = $elem->getTire()->getPrice() * $elem->getQuantity();
            }
        }

        $totalPrice = array_sum($totalPrice);

        return $totalPrice;
    }

    public function getDiscount(CartItemCollection $collection): float
    {
        $totalPrice = $this->getTotalPrice($collection);
        if ($totalPrice > 400) {
            $discount = (float)number_format($totalPrice * 0.05, 2);
        } else {
            $discount = 0;
        }

        return $discount;
    }

    public function getTotalCost(CartItemCollection $collection): float
    {
        $totalCost = $this->getTotalPrice($collection) - $this->getDiscount($collection) + 15;

        return $totalCost;
    }

    public function mergeCartsAnonymousAndUser(User $user, User $anonymousUser)
    {
        $collection = $this->getItemFromCart($anonymousUser);
        foreach ($collection as $item) {
            if ($repeatItem = $this->cartItemRepository->findByUserAndTire($user, $item->getTire())) {
                $repeatItem->setQuantity($repeatItem->getQuantity() + $item->getQuantity() - 1);
                $this->cartItemRepository->update($repeatItem);
            }
            $this->addToCart($user, $item->getTire());
            $this->deleteItem($item);
        }
        $this->userRepository->delete($anonymousUser);
    }
}