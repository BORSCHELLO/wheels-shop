<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     *@Route("/", name="home")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     *@Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('login.html.twig');
    }

    /**
     *@Route("/cart", name="cart")
     */
    public function cart()
    {
        return $this->render('cart.html.twig');
    }

    /**
     *@Route("/shop", name="shop")
     */
    public function shop()
    {
        return $this->render('shop.html.twig');
    }

    /**
     *@Route("/contacts", name="contacts")
     */
    public function contacts()
    {
        return $this->render('contacts.html.twig');
    }

    /**
     *@Route("/details", name="details")
     */
    public function details()
    {
        return $this->render('product-details.html.twig');
    }
}