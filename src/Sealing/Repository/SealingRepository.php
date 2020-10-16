<?php

namespace App\Sealing\Repository;

use App\Sealing\Entity\Sealing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sealing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sealing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sealing[]    findAll()
 * @method Sealing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SealingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sealing::class);
    }

    // /**
    //  * @return Sealing[] Returns an array of Sealing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sealing
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
