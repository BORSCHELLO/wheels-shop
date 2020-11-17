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

    public function getTotalPrice(CartItemCollection $collection): float
    {
        foreach ($collection as $elem) {
            $totalPrice[] = $elem->getTire()->getPrice() * $elem->getQuantity();
        }

        $totalPrice = array_sum($totalPrice);

        return $totalPrice;
    }

    public function getDiscount(CartItemCollection $collection): float
    {
        $totalPrice = $this->getTotalPrice($collection);
        if($totalPrice > 400)
        {
            $discount = $totalPrice * 0.05;
        }else{
            $discount = 0;
        }

        return $discount;
    }

    public function getTotalCost(CartItemCollection $collection): float
    {
        $totalCost = $this->getTotalPrice($collection)-$this->getDiscount($collection)+15;

        return $totalCost;
    }

    public function mergeCartsAnonymousAndUser(User $user, User $anonymousUser)
    {
        $collection = $this->getItemFromCart($anonymousUser);
        foreach ($collection as $item)
        {
            if($repeatItem = $this->cartItemRepository->findByUserAndTire($user, $item->getTire()))
            {
                $repeatItem->setQuantity($repeatItem->getQuantity()+$item->getQuantity()-1);
                $this->cartItemRepository->update($repeatItem);
            }
            $this->addToCart($user, $item->getTire());
            $this->deleteItem($item->getId());
        }
        $this->userRepository->delete($anonymousUser);
    }
}