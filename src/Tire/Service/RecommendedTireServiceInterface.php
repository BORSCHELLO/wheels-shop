<?php

declare(strict_types=1);

namespace App\Tire\Service;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;

interface RecommendedTireServiceInterface
{
    /**
     * @Todo write description
     *
     * @return TireCollection
     */
    public function getCollectionForHomePage(int $limit): TireCollection;

    /**
     * @Todo write description
     *
     * @param Tire $tire
     * @param int $count
     * @return TireCollection
     */
    public function getRelevantCollectionByTire(Tire $tire, int $count): TireCollection;

    /**
     * @Todo write description
     *
     * @return TireCollection
     */
    public function getRecommendedCollectionBrand(int $count, int $limit): TireCollection;
}