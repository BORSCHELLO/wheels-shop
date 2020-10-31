<?php

declare(strict_types=1);

namespace App\Tire\Service;

use App\Brand\Service\RecommendedBrandServiceInterface;
use App\Controller\HomeController;
use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;

class RecommendedTireService implements RecommendedTireServiceInterface
{
    private TireRepositoryInterface $tireRepository;
    private RecommendedBrandServiceInterface $recommendedBrandService;

    public function __construct(TireRepositoryInterface $tireRepository, RecommendedBrandServiceInterface $recommendedBrandService)
    {
        $this->tireRepository = $tireRepository;
        $this->recommendedBrandService = $recommendedBrandService;
    }

    /**
     * @inheritDoc
     */
    public function getCollectionForHomePage(): TireCollection
    {
        $limit = HomeController::PRODUCT_HOME_LIMIT;

        return $this->tireRepository->getProducts(true, $limit);
    }

    /**
     * @inheritDoc
     */
    public function getRelevantCollectionByTire(Tire $tire, int $count): TireCollection
    {
        return $this->tireRepository->getRelevantByDiameter([$tire->getId()], $tire->getDiameter(), $count);
    }

    /**
     * @inheritDoc
     */
    public function getRecommendedCollectionBrand(): TireCollection
    {
        $count = HomeController::BRAND_COLLECTION_LIMIT;
        $brands = $this->recommendedBrandService->getCollectionBrand();
        $brandTires=[];

        foreach ($brands as $brand)
        {
            $brandTires[] = $this->tireRepository->getBrandCollection($brand, $count);
        }

        return new TireCollection($brandTires);
    }
}