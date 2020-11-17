<?php

namespace App\User\Repository;

use App\User\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function create(User $user): User
    {
        $this->_em->persist($user);
        $this->_em->flush();

        return $user;
    }

    public function findById(int $id): ?User
    {
        return $this->find($id);
    }

    public function delete(User $user): void
    {
        $item = $this->find($user);
        $this->_em->remove($item);
        $this->_em->flush();
    }
}
