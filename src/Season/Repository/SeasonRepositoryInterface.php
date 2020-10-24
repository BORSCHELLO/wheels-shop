<?php

declare(strict_types=1);

namespace App\Season\Repository;

use App\Season\Entity\Season;

interface SeasonRepositoryInterface
{
    public function create(Season $season): Season;
}