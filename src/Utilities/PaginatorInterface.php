<?php

declare(strict_types=1);

namespace App\Utilities;


interface PaginatorInterface
{
    public function countPage(int $limit, int $countElements): int;

    public function currentPage(int $limit, int $page): int;
}