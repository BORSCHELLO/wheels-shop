<?php

declare(strict_types=1);

namespace App\OrderItem\Service;


use App\Cart\Collection\CartItemCollection;
use App\Cart\Service\CartService;
use App\Order\Entity\Order;
use App\OrderItem\Entity\OrderItem;
use App\OrderItem\Repository\OrderItemRepositoryInterface;

class OrderItemService implements OrderItemServiceInterface
{
    private $orderItemRepository;

    private $cartService;

    public function __construct(
        OrderItemRepositoryInterface $orderItemRepository,
        CartService $cartService
    ) {
        $this->orderItemRepository = $orderItemRepository;
        $this->cartService = $cartService;
    }

    public function createOrderItems(Order $order, CartItemCollection $collection): OrderItem
    {
        foreach ($collection as $item)
        {$orderItem = new OrderItem();
            $orderItem->setOrder($order);
            $orderItem->setTire($item->getTire());
            $orderItem->setQuantity($item->getQuantity());
            $orderItem->setCost($item->getTire()->getPrice()*$item->getQuantity());

            $this->orderItemRepository->create($orderItem);

            $this->cartService->deleteItem($item);
        }

        return $orderItem;
    }
}