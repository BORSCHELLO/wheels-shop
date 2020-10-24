<?php

declare(strict_types=1);

namespace App\Sealing\Repository;


use App\Sealing\Entity\Sealing;

interface SealingRepositoryInterface
{
    public function create(Sealing $sealing): Sealing;
}