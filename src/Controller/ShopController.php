<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tire\Service\FiltersTireServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     *@Route("/shop", name="shop")
     */
    public function shop(FiltersTireServiceInterface $filtersTireService)
    {
        return $this->render('shop.html.twig',
            [
            'filters' =>$filtersTireService->getCollectionFiltersForShop()
            ]
        );
    }
}