<?php

declare(strict_types=1);

namespace App\Tire\Service;


interface ShopFiltersServiceInterface
{
    public function getCollectionFiltersForShop(): array;
}