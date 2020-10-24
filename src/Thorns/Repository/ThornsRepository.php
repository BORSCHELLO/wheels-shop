<?php

namespace App\Thorns\Repository;

use App\Thorns\Entity\Thorns;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Thorns|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thorns|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thorns[]    findAll()
 * @method Thorns[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThornsRepository extends ServiceEntityRepository implements ThornsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Thorns::class);
    }

    public function create(Thorns $thorns): Thorns
    {
        $this->_em->persist($thorns);
        $this->_em->flush();

        return $thorns;
    }
    // /**
    //  * @return Thorns[] Returns an array of Thorns objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Thorns
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
