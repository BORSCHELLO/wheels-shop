<?php
declare(strict_types=1);
namespace App\Tire\Repository;

use App\Tire\Collection\TireCollection;

interface TireRepositoryInterface
{
    public function getProducts(int $visibility): ?TireCollection;
}