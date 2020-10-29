<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tire\Entity\Tire;
use App\Tire\Service\RecommendedTireServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TireController extends AbstractController
{
    /**
     *@Route("/tire/details/{id}", name="tire/details")
     */
    public function details(Tire $tire, RecommendedTireServiceInterface $recommendedTireService)
    {
        $count = 5;
        return $this->render('tire/details.html.twig', [
            'tire' => $tire,
            'recommended' => $recommendedTireService->getRelevantCollectionByTire($tire, $count)
            ]);
    }
}
