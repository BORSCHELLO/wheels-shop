<?php

namespace App\Tire\Repository;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Tire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tire[]    findAll()
 * @method Tire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireRepository extends ServiceEntityRepository implements TireRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tire::class);
    }

    public function getProducts(int $visibility): ?TireCollection
    {
        return new TireCollection($this->createQueryBuilder('u')
            ->andWhere('u.enabled = :val')
            ->setParameter('val', $visibility)
            ->getQuery()
            ->getResult()
        );
    }

    public function getProductsById(int $id): ?TireCollection
    {
        return new TireCollection($this->createQueryBuilder('u')
            ->andWhere('u.enabled = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        );
    }
}
