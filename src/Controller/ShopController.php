<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tire\Service\FiltersTireServiceInterface;
use App\Tire\Service\ShopsTireServiceInterface;
use App\Utilities\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    const TIRES_LIMIT_SHOP_PAGE = 2;

    /**
     *@Route("/shop/page/{page}", name="shop/page")
     */
    public function shop($page, FiltersTireServiceInterface $filtersTireService, ShopsTireServiceInterface $shopsTireService, PaginatorInterface $paginator)
    {
        $countElement = $shopsTireService->getCollectionForPaginator();

        return $this->render('shop/page.html.twig',
            [
            'filters' =>$filtersTireService->getCollectionFiltersForShop(),
            'tires' => $shopsTireService->getCollectionForShopPage(self::TIRES_LIMIT_SHOP_PAGE, $paginator->currentPage(self::TIRES_LIMIT_SHOP_PAGE, (int) $page)),
            'paginator' => [$page, $paginator->countPage(self::TIRES_LIMIT_SHOP_PAGE, $countElement)]
            ]
        );
    }
}