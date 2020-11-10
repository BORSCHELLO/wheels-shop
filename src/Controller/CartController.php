<?php

declare(strict_types=1);

namespace App\Controller;

use App\Cart\Service\CartServiceInterface;
use App\Tire\Entity\Tire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController  extends AbstractController
{
    /**
     *@Route("/cart/add/{id}", name="cart/add")
     */
    public function addToCart(Tire $tire, CartServiceInterface $cartService)
    {
        $cartService->addToCart($this->getUser(), $tire);

        return $this->redirectToRoute('cart');
    }
}