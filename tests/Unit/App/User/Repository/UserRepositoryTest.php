<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\User\Repository;

use App\Tests\Unit\DoctrineTestCase;
use App\User\Entity\User;
use App\User\Repository\UserRepositoryInterface;

class UserRepositoryTest extends DoctrineTestCase
{
    private UserRepositoryInterface $userRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->userRepository= $this->em->getRepository(User::class);
    }

    public function testCreate()
    {
        $user = new User();
        $user->setName('testName')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user);

        $this->assertEquals(1, $user->getId());
        $this->assertEquals('testName', $user->getName());
        $this->assertEquals('test@mail.ru', $user->getEmail());
        $this->assertEquals('123', $user->getPassword());
        $this->assertEquals('testFirstName', $user->getFirstName());
        $this->assertEquals('testLastName', $user->getLastName());
        $this->assertEquals('testAdress', $user->getAddress());
        $this->assertEquals(1234, $user->getPostalCode());
        $this->assertEquals('12334', $user->getPhone());
    }

    public function testFindById()
    {
        $user1 = new User();
        $user1->setName('testName1')
            ->setEmail('test@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user1);

        $user2 = new User();
        $user2->setName('testName2')
            ->setEmail('test1@mail.ru')
            ->setPassword('123')
            ->setFirstName('testFirstName')
            ->setLastName('testLastName')
            ->setAddress('testAdress')
            ->setPostalCode(1234)
            ->setPhone('12334');
        $this->userRepository->create($user2);

        $collection = $this->userRepository->findById(1);
        $this->assertEquals($user1, $collection);

        $collection2 = $this->userRepository->findById(2);
        $this->assertEquals($user2, $collection2);

        $collection1 = $this->userRepository->findById(3);
        $this->assertEmpty($collection1);
    }
}