<?php

declare(strict_types=1);

namespace App\Controller;

use App\Cart\Entity\CartItem;
use App\Cart\Service\CartAnonymousServiceInterface;
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
    public function addToCart(Tire $tire, CartServiceInterface $cartService, CartAnonymousServiceInterface $cartAnonymousService)
    {
        if($this->getUser()) {
            $cartService->addToCart($this->getUser(), $tire);

            return $this->redirectToRoute('cart');
        }
            $cartAnonymousService->addItems($tire);
        return $this->redirectToRoute('cart');
    }

    /**
     *@Route("/cart", name="cart")
     */
    public function getCartElements(CartServiceInterface $cartService, CartAnonymousServiceInterface $cartAnonymousService)
    {
        if($this->getUser()){
            $items = $cartService->getItemFromCart($this->getUser());
            $totalPrice = $cartService->getTotalPrice($items);
            $discount = $cartService->getDiscount($items);
            $totalCost = $cartService->getTotalCost($items);

            return $this->render('cart.html.twig',
                [
                    'items' => $items,
                    'userInfo' =>  $this->getUser(),
                    'totalPrice' => $totalPrice,
                    'discount' => $discount,
                    'totalCost' => $totalCost
                ]
            );
        }
        $tires = $cartAnonymousService->getTires();
        $quantity = $cartAnonymousService->getQuantity();
        $totalPrice = $cartAnonymousService->getTotalPrice();
        $discount = $cartAnonymousService->getDiscount();
        $totalCost = $cartAnonymousService->getTotalCost();

        return $this->render('cart.html.twig',
            [
                'tires' => $tires,
                'quantity' => $quantity,
                'totalPrice' => $totalPrice,
                'discount' => $discount,
                'totalCost' => $totalCost
            ]
        );
    }

    /**
     * @Route("cart/delete", name="delete")
     */
    public function deleteItem(Request $request, CartServiceInterface $cartService, CartAnonymousServiceInterface $cartAnonymousService)
    {
        if($this->getUser()) {
            $cartService->deleteItem((int)$request->get('id'));

            return new JsonResponse('ok');
        }
        $cartAnonymousService->deleteItem((int)$request->get('id'));

        return new JsonResponse('ok');
    }

    /**
     * @Route("cart/increment", name="increment")
     */
    public function incrementQuantity(Request $request, CartServiceInterface $cartService, CartAnonymousServiceInterface $cartAnonymousService)
    {
        if($this->getUser()) {
        $item = $cartService->incrementItem((int) $request->get('id'), 1);
        $quantity = $item->getQuantity();

        return new JsonResponse($quantity);
        }

        $quantity = $cartAnonymousService->increment((int) $request->get('id'));

        return new JsonResponse($quantity);
    }

    /**
     * @Route("cart/decrement", name="decrement")
     */
    public function decrementQuantity(Request $request, CartServiceInterface $cartService, CartAnonymousServiceInterface $cartAnonymousService)
    {
        if($this->getUser()) {
        $item = $cartService->decrementItem((int) $request->get('id'), 1);
        $quantity = $item->getQuantity();

        return new JsonResponse($quantity);
        }
        $quantity = $cartAnonymousService->decrement((int) $request->get('id'));

        return new JsonResponse($quantity);
    }
}