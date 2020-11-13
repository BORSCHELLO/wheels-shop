<?php

declare(strict_types=1);

namespace App\Controller;

use App\Cart\Entity\CartItem;
use App\Cart\Service\CartServiceInterface;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     *@Route("/cart", name="cart")
     */
    public function getItem(CartServiceInterface $cartService)
    {
        $user = $this->getUser();

        return $this->render('cart.html.twig',
        [
            'items' =>$cartService->getItemFromCart($user)
        ]
        );
    }

    /**
     * @Route("cart/delete", name="delete")
     */
    public function deleteItem(Request $request, CartServiceInterface $cartService)
    {
        $cartService->deleteItem($request->get('id'));

        return new JsonResponse('ok');
    }

    /**
     * @Route("cart/increment", name="increment")
     */
    public function incrementQuantity(Request $request, CartServiceInterface $cartService)
    {
        $item = $cartService->incrementItem((int) $request->get('id'), 1);
        $quantity = $item->getQuantity();

        return new JsonResponse($quantity);
    }

    /**
     * @Route("cart/decrement", name="decrement")
     */
    public function decrementQuantity(Request $request, CartServiceInterface $cartService)
    {
        $item = $cartService->decrementItem((int) $request->get('id'), 1);
        $quantity = $item->getQuantity();

        return new JsonResponse($quantity);
    }
}