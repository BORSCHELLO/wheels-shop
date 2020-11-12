<?php

namespace App\Cart\Repository;

use App\Cart\Collection\CartItemCollection;
use App\Cart\Entity\CartItem;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CartItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartItem[]    findAll()
 * @method CartItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartItemRepository extends ServiceEntityRepository implements CartItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function create(CartItem $cartItem): CartItem
    {
        $this->_em->persist($cartItem);
        $this->_em->flush();

        return $cartItem;
    }

    public function findByUserAndTire(User $user, Tire $tire): ?CartItem
    {
        return $this->findOneBy([
            'user' => $user,
            'tire' => $tire
        ]);
    }

    public function increaseQuantity(CartItem $cartItem, int $quantity = 1): CartItem
    {
        $item = $cartItem->increaseQuantity($quantity);
        $this->create($item);

        return $item;
    }

    public function getItemCollection(User $user): ?CartItemCollection
    {
        $cartItem = $this->createQueryBuilder('c')
            ->select('c', 'tire')
            ->join('c.tire', 'tire')
            ->andWhere('c.user = :val')
            ->setParameter('val', $user)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        return new CartItemCollection($cartItem);
    }

    public function delete($id): void
    {
        $item = $this->find($id);
        $this->_em->remove($item);
        $this->_em->flush();
    }

    public function increment($id, $quantity): CartItem
    {
        $item = $this->find($id);
        $item->increaseQuantity($quantity);
        $this->create($item);

        return $item;
    }

    public function decrement($id, $quantity): CartItem
    {
        $item = $this->find($id);
        $item->decreaseQuantity($quantity);
        $this->create($item);

        return $item;
    }

    // /**
    //  * @return Cart[] Returns an array of Cart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cart
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
