<?php

declare(strict_types=1);

namespace App\Tire\Service;


use App\Tire\Collection\TireCollection;
use App\Tire\Repository\TireRepositoryInterface;

class ShopsTireService implements ShopsTireServiceInterface
{
    private TireRepositoryInterface $tireRepository;

    public function __construct(TireRepositoryInterface $tireRepository)
    {
        $this->tireRepository = $tireRepository;
    }

    /**
     * @inheritDoc
     */
    public function getCollectionForShopPage(int $limit, int $offset): TireCollection
    {
        return $this->tireRepository->getTiresForShop(true, $limit, $offset);
    }

    public function getCountTiresForPaginator(): int
    {
       return count($this->tireRepository->getTiresForPaginator(true));
    }
}