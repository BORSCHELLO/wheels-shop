<?php


namespace App\Controller;

use App\Category\Repository\CategoryRepository;
use App\Response\Filter\CategoryJsonResponse;
use App\Response\Tire\TireJsonResponse;
use App\Tire\Repository\TireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route ("/filter-data" , name="filter-data")
     * @param Request $request
     */
    public function passFilterData(CategoryRepository $categoryRepository)
    {
        return new CategoryJsonResponse($categoryRepository->getCategory(1));
    }

    /**
     * @Route ("/showProducts" , name="showProducts")
     * @param Request $request
     */
    public function showProducts(TireRepository $tireRepository)
    {
        return new TireJsonResponse($tireRepository->getProducts(1));
    }

}