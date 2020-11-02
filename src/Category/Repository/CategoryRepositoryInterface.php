<?php
declare(strict_types=1);
namespace App\Category\Repository;

use App\Category\Collection\CategoryCollection;
use App\Category\Entity\Category;

interface CategoryRepositoryInterface
{

    public function create(Category $category): Category;

    public function getCategory(bool $visibility): ?CategoryCollection;

    public function getCategorysForFilters(bool $visibility): ?CategoryCollection;
}