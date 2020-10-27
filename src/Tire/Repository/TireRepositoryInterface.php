<?php
declare(strict_types=1);
namespace App\Tire\Repository;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;

interface TireRepositoryInterface
{
    public function create(Tire $tire): Tire;

    public function getProducts(int $visibility): ?TireCollection;

    public function getProductsById(int $id): ?TireCollection;
}