<?php
declare(strict_types=1);

namespace App\Tire\Repository;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
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

    public function create(Tire $tire): Tire
    {
        $this->_em->persist($tire);
        $this->_em->flush();

        return $tire;
    }

    public function getProducts(bool $enabled, int $limit): TireCollection
    {
        return new TireCollection($this->createQueryBuilder('u')
            ->andWhere('u.enabled = :val')
            ->setParameter('val', $enabled)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        );
    }

    public function findEnabledById(int $id): ?Tire
    {
        return $this->findOneBy(['id'=> $id, 'enabled' => true]);
    }

    public function getRelevantByDiameter(array $excludedIds, int $diameter, int $limit): TireCollection
    {
        $builder = $this->createQueryBuilder('t')
            ->andWhere('t.enabled = 1')
            ->andWhere('t.id NOT IN (:excludeIds)')
            ->andWhere('t.diameter = :diameter')
            ->setParameter('excludeIds', $excludedIds, Connection::PARAM_INT_ARRAY)
            ->setParameter('diameter', $diameter)
            ->setMaxResults($limit);

        return new TireCollection($builder->getQuery()->getResult());
    }

    public function getTireForBrandCollection($brand, int $limit): TireCollection
    {
        $builder = $this->createQueryBuilder('t')
            ->andWhere('t.enabled = true')
            ->andWhere('t.brand = :brand')
            ->setParameter('brand', $brand)
            ->setMaxResults($limit);

        return new TireCollection($builder->getQuery()->getResult());
    }

    public function getPrice(bool $enabled): ?array
    {
        return $this->createQueryBuilder('p')
            ->select('p.price')
            ->andWhere('p.enabled = :val')
            ->setParameter('val', $enabled)
            ->getQuery()
            ->getResult();
    }

    public function getProductsForFilters(bool $enabled): TireCollection
    {
        return new TireCollection($this->createQueryBuilder('t')
            ->select('t.width, t.height, t.diameter, t.speedIndex, t.loadIndex, t.marketLaunchDate')
            ->andWhere('t.enabled = :val')
            ->setParameter('val', $enabled)
            ->getQuery()
            ->getResult()
        );
    }

    public function getTiresForPaginator(bool $enabled): TireCollection
    {
        return new TireCollection($this->createQueryBuilder('u')
            ->orderBy('u.id','DESC')
            ->andWhere('u.enabled = :val')
            ->setParameter('val', $enabled)
            ->getQuery()
            ->getResult()
        );
    }

    public function getTiresForShop(bool $enabled, int $limit, int $offset): TireCollection
    {
        return new TireCollection($this->createQueryBuilder('u')
            ->orderBy('u.id','DESC')
            ->andWhere('u.enabled = :val')
            ->setParameter('val', $enabled)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        );
    }
}
