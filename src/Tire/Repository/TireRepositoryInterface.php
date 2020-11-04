<?php
declare(strict_types=1);
namespace App\Tire\Repository;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;

interface TireRepositoryInterface
{
    public function create(Tire $tire): Tire;

    public function getProducts(bool $visibility, int $limit): TireCollection;

    public function findEnabledById(int $id): ?Tire;

    public function getRelevantByDiameter(array $excludedIds, int $diameter, int $limit): TireCollection;

    public function getTireForBrandCollection($brand, int $limit): TireCollection;

    public function getPrice(bool $visibility): ?array;

    public function getProductsForFilters(bool $visibility): TireCollection;

    public function getTiresForPaginator(bool $visibility): TireCollection;
}