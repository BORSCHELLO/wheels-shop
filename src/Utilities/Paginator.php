<?php

declare(strict_types=1);

namespace App\Utilities;

class Paginator implements PaginatorInterface
{
    public function countPage(int $limit, int $countElements): int
    {
        $countPage = (int) ceil($countElements/$limit);

        return $countPage;

    }

    public function offset(int $limit, int $page): int
    {
        $offset = $limit*($page-1);

        return $offset;
    }
}