<?php

declare(strict_types=1);

namespace App\Design\Repository;

use App\Design\Entity\Design;

interface DesignRepositoryInterface
{
    public function create(Design $design): Design;
}