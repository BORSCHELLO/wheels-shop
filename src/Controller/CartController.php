<?php

declare(strict_types=1);

namespace App\Controller;


use App\Cart\Service\CartOperationsServiceInterface;
use App\Tire\Repository\TireRepositoryInterface;
use App\User\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController  extends AbstractController
{
    /**
     *@Route("/cart/add/{id}", name="cart/add")
     */
    public function addToCart($id, Request $request, UserRepositoryInterface $userRepository, TireRepositoryInterface $tireRepository, CartOperationsServiceInterface $cartOperationsService)
    {
        $user = $userRepository->findById(2);
        $tire = $tireRepository->findEnabledById((int) $id);

        $cartOperationsService->addToCart($user, $tire);

        return $this->redirect($request->server->get('HTTP_REFERER'));
    }
}