<?php

declare(strict_types=1);

namespace App\Controller;

use App\Order\Service\OrderServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("order/add", name="order")
     */
    public function addToOrder(Request $request, OrderServiceInterface $orderService)
    {
        $arr = $orderService->getOrder($request);

        return new JsonResponse($arr);
    }
}