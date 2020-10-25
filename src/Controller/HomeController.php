<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tire\Service\RecommendedTireServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     *@Route("/", name="home")
     */
    public function home(RecommendedTireServiceInterface $recommendedTireService)
    {
        return $this->render('home.html.twig',
            [
                'tires' => $recommendedTireService->getCollectionForHomePage(),
                //'brands' => $brands,
            ]
        );
    }
}