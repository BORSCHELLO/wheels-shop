<?php
declare(strict_types=1);
namespace App\Category\Repository;

use App\Category\Collection\CategoryCollection;
use App\Category\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function create(Category $category): Category
    {
        $this->_em->persist($category);
        $this->_em->flush();

        return $category;
    }

    public function getCategorysForFilters(bool $visibility): ?CategoryCollection
    {
        return new CategoryCollection($this->createQueryBuilder('c')
            ->select('c.id, c.name')
            ->andWhere('c.enabled = :val')
            ->setParameter('val', $visibility)
            ->getQuery()
            ->getResult()
        );
    }
}
