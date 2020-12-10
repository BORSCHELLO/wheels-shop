<?php

declare(strict_types=1);

namespace App\Controller;

use App\Cart\Entity\CartItem;
use App\Cart\Service\CartServiceInterface;
use App\Tire\Entity\Tire;
use App\User\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CartController extends AbstractController
{

    /**
     * @Route("/cart/add/{id}", name="cart/add")
     */
    public function addToCart(Tire $tire, CartServiceInterface $cartService, UserServiceInterface $userService)
    {
        if ($this->getUser()) {
            $cartService->addToCart($this->getUser(), $tire);

            return $this->redirectToRoute('cart');
        }

        $user = $userService->anonymousRegistration();
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);
        $cartService->addToCart($this->getUser(), $tire);

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart", name="cart")
     */
    public function getCartElements(CartServiceInterface $cartService)
    {
        if ($this->getUser() && $this->get('session')->get('anonymousUser')) {
            $cartService->mergeUsersCart($this->getUser(), $this->get('session')->get('anonymousUser'));
            $this->get('session')->remove('anonymousUser');
        }

        if ($this->getUser()) {
            $items = $cartService->getItemFromCart($this->getUser());
            $totalPrice = $cartService->getTotalPrice($items);
            $discount = $cartService->getDiscount($items);
            $totalCost = $cartService->getTotalCost($items);

            return $this->render('cart.html.twig',
                [
                    'items' => $items,
                    'userInfo' => $this->getUser(),
                    'totalPrice' => $totalPrice,
                    'discount' => $discount,
                    'totalCost' => $totalCost
                ]
            );
        }

        return $this->render('cart.html.twig');
    }

    /**
     * @Route("cart/delete/{cartItem}", name="delete")
     */
    public function deleteItem(CartItem $cartItem, CartServiceInterface $cartService)
    {
        $cartService->deleteItem($cartItem);

        return new JsonResponse('ok');
    }

    /**
     * @Route("cart/increment/{cartItem}", name="increment")
     */
    public function incrementQuantity(CartItem $cartItem, CartServiceInterface $cartService)
    {
        $item = $cartService->incrementQuantity($this->getUser(), $cartItem, 1);
        if ($item) {
            $quantity = $item->getQuantity();

            return new JsonResponse($quantity);
        }

        return new JsonResponse('Неудалось');
    }

    /**
     * @Route("cart/decrement/{cartItem}", name="decrement")
     */
    public function decrementQuantity(CartItem $cartItem, CartServiceInterface $cartService)
    {
        $item = $cartService->decrementQuantity($this->getUser(), $cartItem, 1);
        if ($item) {
            $quantity = $item->getQuantity();

            return new JsonResponse($quantity);
        }

        return new JsonResponse('Неудалось');
    }
}