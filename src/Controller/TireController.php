<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tire\Entity\Tire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TireController extends AbstractController
{
    /**
     *@Route("/tire/details/{id}", name="tire/details")
     */
    public function details(Tire $tire)
    {
        return $this->render('tire/details.html.twig', ['tire' => $tire]);
    }
}
