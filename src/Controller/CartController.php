<?php

declare(strict_types=1);

namespace App\Controller;

use App\Cart\Entity\CartItem;
use App\Cart\Service\CartServiceInterface;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use App\User\Repository\UserRepositoryInterface;
use App\User\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CartController  extends AbstractController
{

    /**
     *@Route("/cart/add/{id}", name="cart/add")
     */
    public function addToCart(Tire $tire, CartServiceInterface $cartService, UserServiceInterface $userService)
    {
        if($this->getUser()) {
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
     *@Route("/cart", name="cart")
     */
    public function getCartElements(CartServiceInterface $cartService)
    {
        if ($this->getUser() and $this->get('session')->get('anonymousUser'))
        {
            $cartService->mergeCartsAnonymousAndUser($this->getUser(), $this->get('session')->get('anonymousUser'));
            $this->get('session')->remove('anonymousUser');
        }

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

        return $this->render('cart.html.twig');
    }

    /**
     * @Route("cart/delete", name="delete")
     */
    public function deleteItem(Request $request, CartServiceInterface $cartService)
    {
            $cartService->deleteItem((int)$request->get('id'));

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