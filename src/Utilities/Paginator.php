<?php

declare(strict_types=1);

namespace App\Utilities;


use App\Tire\Repository\TireRepositoryInterface;

class Paginator implements PaginatorInterface
{
    private TireRepositoryInterface $tireRepository;

    public function __construct(TireRepositoryInterface $tireRepository)
    {
        $this->tireRepository = $tireRepository;
    }

    public function countPage(int $limit, int $countElements): int
    {
        $countPage = (int) ceil($countElements/$limit);

        return $countPage;

    }

    public function currentPage(int $limit, int $page): int
    {
        $offset = $limit*($page-1);

        return $offset;
    }
}