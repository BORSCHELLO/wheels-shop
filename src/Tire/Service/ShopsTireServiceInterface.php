<?php

declare(strict_types=1);

namespace App\Tire\Service;


use App\Tire\Collection\TireCollection;

interface ShopsTireServiceInterface
{
    public function getCollectionForShopPage(int $limit, int $offset): TireCollection;

    public function getCollectionForPaginator();
}