<?php

declare(strict_types=1);

namespace App\Controller;

use App\Brand\Service\RecommendedBrandServiceInterface;
use App\Tire\Service\RecommendedTireServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    const PRODUCT_HOME_LIMIT = 6;
    const BRAND_HOME_LIMIT = 6;
    const BRAND_COLLECTION_LIMIT = 4;
    /**
     *@Route("/", name="home")
     */
    public function home(RecommendedTireServiceInterface $recommendedTireService, RecommendedBrandServiceInterface $recommendedBrandService)
    {
        return $this->render('home.html.twig',
            [
                'tires' => $recommendedTireService->getCollectionForHomePage(self::PRODUCT_HOME_LIMIT),
                'brands' => $recommendedBrandService->getCollectionBrand(self::BRAND_HOME_LIMIT),
                'brandTires' => $recommendedTireService->getRecommendedCollectionBrand(self::BRAND_COLLECTION_LIMIT, self::BRAND_HOME_LIMIT)
            ]
        );
    }
}