<?php

declare(strict_types=1);

namespace App\Controller;

use App\Brand\Repository\BrandRepository;
use App\Response\Brand\BrandJsonResponse;
use App\Response\Tire\TireJsonResponse;
use App\Tire\Repository\TireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     *@Route("/", name="home")
     */
    public function home(TireRepository $tireRepository, BrandRepository $brandRepository)
    {
        $limit = $_ENV['SHOW_PRODUCTS_LIMIT'];
        $products= new TireJsonResponse($tireRepository->getRandId((int)$limit));
        $brands= new BrandJsonResponse($brandRepository->getBrand(1));

        return $this->render('home.html.twig',
            [
                'products' => $products,
                'brands' => $brands,
            ]
        );
    }
}