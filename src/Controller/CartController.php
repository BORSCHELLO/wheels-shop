<?php

declare(strict_types=1);

namespace App\Controller;


use App\Cart\Service\CartServiceInterface;
use App\Tire\Entity\Tire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController  extends AbstractController
{
    /**
     *@Route("/cart/add/{id}", name="cart/add")
     */
    public function addToCart(Tire $tire, Request $request, CartServiceInterface $cartService)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $cartService->addToCart($user, $tire);

        return $this->redirectToRoute('cart');
    }
}