<?php

namespace App\Brand\Repository;

use App\Brand\Collection\BrandCollection;
use App\Brand\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Brand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brand[]    findAll()
 * @method Brand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandRepository extends ServiceEntityRepository implements BrandRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
    }

    public function create(Brand $brand): Brand
    {
        $this->_em->persist($brand);
        $this->_em->flush();

        return $brand;
    }

    public function getBrand(int $visibility): ?BrandCollection
    {
        return new BrandCollection($this->createQueryBuilder('u')
            ->andWhere('u.enabled = :val')
            ->setParameter('val', $visibility)
            ->getQuery()
            ->getResult()
        );
    }
}
