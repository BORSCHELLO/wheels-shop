<?php

declare(strict_types=1);

namespace App\Thorns\Repository;


use App\Thorns\Entity\Thorns;

interface ThornsRepositoryInterface
{
    public function create(Thorns $thorns): Thorns;
}