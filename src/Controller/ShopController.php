<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tire\Service\ShopFiltersServiceInterface;
use App\Tire\Service\ShopsTireServiceInterface;
use App\Utilities\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    const TIRES_LIMIT_SHOP_PAGE = 4;

    /**
     *@Route("/shop/page/{page}", name="shop/page")
     */
    public function shop($page, ShopFiltersServiceInterface $shopFiltersService, ShopsTireServiceInterface $shopsTireService, PaginatorInterface $paginator)
    {
        $countElement = $shopsTireService->getCountTiresForPaginator();
        $offset = $paginator->offset(self::TIRES_LIMIT_SHOP_PAGE, (int) $page);

        return $this->render('shop/page.html.twig',
            [
            'filters' =>$shopFiltersService->getCollectionFiltersForShop(),
            'tires' => $shopsTireService->getCollectionForShopPage(self::TIRES_LIMIT_SHOP_PAGE, $offset),
            'paginator' => [$page, $paginator->countPage(self::TIRES_LIMIT_SHOP_PAGE, $countElement)]
            ]
        );
    }
}