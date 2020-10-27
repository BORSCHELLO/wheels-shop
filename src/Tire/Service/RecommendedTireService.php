<?php

declare(strict_types=1);

namespace App\Tire\Service;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;

class RecommendedTireService implements RecommendedTireServiceInterface
{
    private TireRepositoryInterface $tireRepository;

    public function __construct(TireRepositoryInterface $tireRepository)
    {
        $this->tireRepository = $tireRepository;
    }

    /**
     * @inheritDoc
     */
    public function getCollectionForHomePage(): TireCollection
    {
        return $this->tireRepository->getProducts(true);
    }

    /**
     * @inheritDoc
     */
    public function getRelevantCollectionByTire(Tire $tire, int $count): TireCollection
    {

    }
}