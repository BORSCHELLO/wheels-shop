<?php


namespace App\Controller;


use App\Response\Tire\TireJsonResponse;
use App\Tire\Repository\TireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
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
     *@Route("/tire/details/{id}", name="tire/details")
     */
    public function details($id, TireRepository $tireRepository)
    {
        $product = new TireJsonResponse($tireRepository->getProductsById($id));
        return $this->render('product-details.html.twig',
            [
            'product' => $product
        ]);
    }
}
