<?php

declare(strict_types=1);
namespace App\Brand\Repository;


use App\Brand\Collection\BrandCollection;
use App\Brand\Entity\Brand;

interface BrandRepositoryInterface
{
    public function create(Brand $brand): Brand;

    public function getBrandsInTires(bool $visibility, int $limit): ?BrandCollection;

    public function getBrandsForFilters(bool $visibility): ?BrandCollection;
}