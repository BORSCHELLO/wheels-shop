<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     *@Route("/login1", name="login1")
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
     *@Route("/contacts", name="contacts")
     */
    public function contacts()
    {
        return $this->render('contacts.html.twig');
    }
}
