<?php


namespace App\Controller;

use App\Category\Repository\CategoryRepository;
use App\Response\Filter\CategoryJsonResponse;
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
}