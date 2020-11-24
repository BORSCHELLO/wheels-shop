<?php

declare(strict_types=1);

namespace App\Order\Service;

use App\Order\Entity\Order;
use App\Order\Repository\OrderRepositoryInterface;
use App\User\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class OrderService implements OrderServiceInterface
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(Request $request, User $user)
    {
        $order = new Order();
        $order->setUser($user);
        $order->setAddress($request->get('address'));
        $order->setPhone($request->get('phone'));
        $order->setFirstName($request->get('firstName'));
        $order->setLastName($request->get('lastName'));
        $order->setNoteOfOrder($request->get('noteOfOrder'));
        $order->setPostalCode($request->get('postalCode'));
        $order->setTotalCost(3.4);
        $order->setPaymentMethod('card');
        $order->setDeliveryMethod('pickup');
        $order->setStatus('processing');

        $this->orderRepository->create($order);

        return 'ok';
    }
}
