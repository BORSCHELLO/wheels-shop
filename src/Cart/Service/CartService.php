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
        $discount = $totalPrice > 400 ? (float)number_format($totalPrice * 0.05, 2) : 0;

        return $discount;
    }

    public function getTotalCost(CartItemCollection $collection): float
    {
        $totalCost = $this->getTotalPrice($collection) - $this->getDiscount($collection);

        return $totalCost;
    }

    public function mergeCartsAnonymousAndUser(User $user, User $anonymousUser): void
    {
        $collection = $this->getItemFromCart($anonymousUser);
        foreach ($collection as $item) {
            if ($repeatItem = $this->cartItemRepository->findByUserAndTire($user, $item->getTire())) {
                $repeatItem->setQuantity($repeatItem->getQuantity() + $item->getQuantity());
                $this->cartItemRepository->update($repeatItem);
                $this->deleteItem($item);
            } else {
                $cartItem = new CartItem();
                $cartItem->setQuantity($item->getQuantity());
                $cartItem->setTire($item->getTire());
                $cartItem->setUser($user);
                $this->deleteItem($item);
                $this->cartItemRepository->create($cartItem);
            }
        }
        $this->userRepository->delete($anonymousUser);
    }
}