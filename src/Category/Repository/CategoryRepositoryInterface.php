<?php
declare(strict_types=1);
namespace App\Category\Repository;

use App\Category\Collection\CategoryCollection;

interface CategoryRepositoryInterface
{
    public function getCategory(int $visibility): ?CategoryCollection;
}