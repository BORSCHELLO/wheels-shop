<?php

declare(strict_types=1);

namespace App\Brand\Service;

use App\Brand\Collection\BrandCollection;
use App\Brand\Entity\Brand;

interface RecommendedBrandServiceInterface
{
    /**
     * @Todo write description
     *
     * @param int $limit
     * @return BrandCollection
     */
    public function getCollectionBrand(int $limit): BrandCollection;
}