<?php

declare(strict_types=1);

namespace App\Order\Service;

use App\Cart\Collection\CartItemCollection;
use App\Cart\Repository\CartItemRepositoryInterface;
use App\Cart\Service\CartServiceInterface;
use App\Order\Entity\Order;
use App\Order\Repository\OrderRepositoryInterface;
use App\OrderItem\Service\OrderItemServiceInterface;
use App\Request\Dto\CreateOrderRequestDto;
use App\Tire\Entity\Tire;
use App\User\Entity\User;

class OrderService implements OrderServiceInterface
{
    private $orderRepository;

    private $cartItemRepository;

    private $cartService;

    private $orderItemService;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        CartItemRepositoryInterface $cartItemRepository,
        CartServiceInterface $cartService,
        OrderItemServiceInterface $orderItemService
    ) {
        $this->orderRepository = $orderRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->cartService = $cartService;
        $this->orderItemService = $orderItemService;
    }

    public function createOrder(
        CreateOrderRequestDto $requestDto,
        User $user,
        int $deliveryCost = self::DELIVERY_COST
    ): Order {
        $labelsDelivery =['courierDelivery' => 'Доставка курьером' , 'pickup' => 'Самовывоз'];
        $labelsPayment =['cash' => 'Оплата наличными' , 'card' => 'Оплата картой'];

        $delivery = 0;
        $order = new Order();
        $order->setUser($user);
        $order->setFirstName($requestDto->firstName);
        $order->setLastName($requestDto->lastName);
        $order->setAddress($requestDto->address);
        $order->setPhone($requestDto->phone);
        $order->setNoteOfOrder($requestDto->noteOfOrder);
        $order->setPostalCode($requestDto->postalCode);
        $order->setPaymentMethod($labelsPayment[$requestDto->paymentMethod]);
        $order->setDeliveryMethod($labelsDelivery[$requestDto->deliveryMethod]);

        if ($requestDto->deliveryMethod == 'courierDelivery') {
            $delivery = $deliveryCost;
        }

        $totalCost = $this->cartService->getTotalCost($this->cartItemRepository->getItemCollection($user)) + $delivery;

        $order->setTotalCost($totalCost);
        $order->setStatus('processing');

        $this->orderRepository->create($order);

        $this->orderItemService->createOrderItems($order, $this->cartService->getItemFromCart($user));

        return $order;
    }
}
