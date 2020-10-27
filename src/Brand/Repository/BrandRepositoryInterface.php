<?php

declare(strict_types=1);
namespace App\Brand\Repository;


use App\Brand\Collection\BrandCollection;
use App\Brand\Entity\Brand;

interface BrandRepositoryInterface
{
    public function create(Brand $brand): Brand;

    public function getBrand(int $visibility): ?BrandCollection;
}