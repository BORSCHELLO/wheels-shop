<?php

declare(strict_types=1);

namespace App\Tire\Service;

use App\Brand\Service\RecommendedBrandServiceInterface;
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
    public function getCollectionForHomePage(int $limit): TireCollection
    {
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
    public function getRecommendedCollectionBrand(int $count, int $limit): TireCollection
    {
        $brands = $this->recommendedBrandService->getCollectionBrand($limit);
        $brandTires=[];

        foreach ($brands as $brand)
        {
            $brandTires[] = $this->tireRepository->getTireForBrandCollection($brand, $count);
        }

        return new TireCollection($brandTires);
    }
}