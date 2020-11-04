<?php

declare(strict_types=1);

namespace App\Brand\Service;

use App\Brand\Collection\BrandCollection;
use App\Brand\Repository\BrandRepositoryInterface;

class RecommendedBrandService implements RecommendedBrandServiceInterface
{
    private BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @inheritDoc
     */
    public function getCollectionBrand(int $limit): BrandCollection
    {
       return $this->brandRepository->getBrandsInTires(true, $limit);
    }
}
