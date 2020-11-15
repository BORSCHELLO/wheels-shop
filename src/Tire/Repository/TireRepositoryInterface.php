<?php
declare(strict_types=1);
namespace App\Tire\Repository;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;

interface TireRepositoryInterface
{
    public function create(Tire $tire): Tire;

    public function getProducts(bool $enabled, int $limit): TireCollection;

    public function findEnabledById(int $id): ?Tire;

    public function getRelevantByDiameter(array $excludedIds, int $diameter, int $limit): TireCollection;

    public function getTireForBrandCollection($brand, int $limit): TireCollection;

    public function getPrice(bool $enabled): ?array;

    public function getProductsForFilters(bool $enabled): TireCollection;

    public function getTiresForPaginator(bool $enabled): TireCollection;

    public function getTiresForCartById(array $ids): TireCollection;
}