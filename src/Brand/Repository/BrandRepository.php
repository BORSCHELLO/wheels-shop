<?php

declare(strict_types=1);

namespace App\Brand\Repository;

use App\Brand\Collection\BrandCollection;
use App\Brand\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Brand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brand[]    findAll()
 * @method Brand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandRepository extends ServiceEntityRepository implements BrandRepositoryInterface
{
    private Connection $connection;

    public function __construct(ManagerRegistry $registry, Connection $connection)
    {
        parent::__construct($registry, Brand::class);

        $this->connection = $connection;
    }

    public function create(Brand $brand): Brand
    {
        $this->_em->persist($brand);
        $this->_em->flush();

        return $brand;
    }


    public function getBrandsInTires(bool $visibility, int $limit): ?BrandCollection
    {
        $qb = $this->connection->createQueryBuilder();
        $brandIds = $qb->select('brand_id')
            ->distinct()
            ->from('tire')
            ->where('enabled = :enabled')
            ->setParameter(':enabled', $visibility)
            ->setMaxResults($limit)
            ->execute()
            ->fetchFirstColumn();

        $brands = $this->findBy(['id' => $brandIds]);

/*        $queryBuilder = $this->connection->createQueryBuilder();
        $brandsNames[] = $queryBuilder->select('name')
            ->from('brand')
            ->where('id IN (:brandIds)')
            ->setParameter('brandIds', $brandIds, Connection::PARAM_INT_ARRAY)
            ->execute()
            ->fetchAll();*/

        return new BrandCollection($brands);
    }

    public function getBrandsForFilters(bool $visibility): ?BrandCollection
    {
        $qb = $this->connection->createQueryBuilder();
        $brandIds = $qb->select('brand_id')
            ->distinct()
            ->from('tire')
            ->where('enabled = :enabled')
            ->setParameter(':enabled', $visibility)
            ->execute()
            ->fetchFirstColumn();

        $brands = $this->findBy(['id' => $brandIds]);

        return new BrandCollection($brands);
    }
}
