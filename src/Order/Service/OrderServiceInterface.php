<?php

declare(strict_types=1);

namespace App\Order\Service;


use App\Order\Repository\OrderRepositoryInterface;
use App\User\Entity\User;
use Symfony\Component\HttpFoundation\Request;

interface OrderServiceInterface
{
    public function createOrder(Request $request, User $user);
}