<?php

declare(strict_types=1);

namespace App\Controller;

use App\Cart\Service\CartServiceInterface;
use App\Order\Service\OrderServiceInterface;
use App\Request\Dto\CreateOrderRequestDto;
use App\Response\Order\OrderJsonResponse;
use App\Response\Order\OrderValidationJsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("order/add", name="order")
     */
    public function addToOrder(CreateOrderRequestDto $requestDto, OrderServiceInterface $orderService, CartServiceInterface $cartService)
    {
        if (count($requestDto->constraintViolations) > 0) {
            return new OrderValidationJsonResponse($requestDto->constraintViolations);
        }

        if ($cartService->isNotEmpty($this->getUser())){
        $arr = $orderService->createOrder($requestDto, $this->getUser());

        return new OrderJsonResponse($arr);
        }

        $error = ['path' => 'cartEmpty', 'message' => 'Корзина пуста!'];

        return new JsonResponse($error);
    }
}