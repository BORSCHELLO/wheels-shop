<?php

declare(strict_types=1);
namespace App\Brand\Repository;


use App\Brand\Collection\BrandCollection;

interface BrandRepositoryInterface
{
    public function getBrand(int $visibility): ?BrandCollection;
}