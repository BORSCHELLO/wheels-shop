<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tire\Entity\Tire;
use App\Tire\Service\RecommendedTireServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TireController extends AbstractController
{
    const COUNT_RELEVANT_TIRE = 5;
    /**
     * @Route("/tire/details/{id}", name="tire/details")
     */
    public function details(Tire $tire, RecommendedTireServiceInterface $recommendedTireService)
    {
        $count=self::COUNT_RELEVANT_TIRE;
        $recommended = $recommendedTireService->getRelevantCollectionByTire($tire, $count);

        return $this->render('tire/details.html.twig', [
            'tire' => $tire,
            'recommended' => $recommended
        ]);
    }
}
